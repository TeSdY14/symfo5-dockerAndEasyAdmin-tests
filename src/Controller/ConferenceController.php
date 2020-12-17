<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Conference;
use App\Form\CommentFormType;
use App\Message\CommentMessage;
use App\Repository\CommentRepository;
use App\Repository\ConferenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ConferenceController.
 */
class ConferenceController extends AbstractController
{
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var MessageBusInterface
     */
    private $bus;

    public function __construct(Environment $twig, EntityManagerInterface $em, MessageBusInterface $bus)
    {
        $this->twig = $twig;
        $this->em = $em;
        $this->bus = $bus;
    }

    /**
     * @Route("/", name="homepage")
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(): Response
    {
        $response = new Response($this->twig->render('conference/index.html.twig', [
        ]));
        // Page d'accueil en cache pendant 1heure !
        $response->setSharedMaxAge(3600);

        return $response;
    }

    /**
     * @Route("/conference_header", name="conference_header")
     *
     * @param ConferenceRepository $conferenceRepository
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function conferenceHeader(ConferenceRepository $conferenceRepository): Response
    {
        $response = new Response($this->twig->render('conference/header.html.twig', [
            'conferences' => $conferenceRepository->findAll(),
        ]));
        $response->setSharedMaxAge(3600);

        return $response;
    }

    /**
     * @Route("/conference/{slug}", name="conference_show")
     *
     * @param Request $request
     * @param Conference $conference
     * @param CommentRepository $commentRepository
     * @param NotifierInterface $notifier
     * @param string $photoDir
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function show(Request $request, Conference $conference, CommentRepository $commentRepository,
                         NotifierInterface $notifier, string $photoDir): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setConference($conference);
            if ($photo = $form['photo']->getData()) {
                dump($photo);
                $filename = bin2hex(random_bytes(6)).'.'.$photo->guessExtension();
                try {
                    $photo->move($photoDir, $filename);
                } catch (FileException $e) {
                    // impossible d'upload l'image envoyée
                }
                $comment->setPhotoFilename($filename);
            }

            $this->em->persist($comment);
            $this->em->flush();

            $context = [
                'user_ip' => $request->getClientIp(),
                'referrer' => $request->headers->get('referer'),
                'permalink' => $request->getUri(),
            ];

            $reviewUrl = $this->generateUrl('review_comment', ['id' => $comment->getId()], UrlGeneratorInterface::ABSOLUTE_URL);
            $this->bus->dispatch(new CommentMessage($comment->getId(), $reviewUrl, $context));

            $notifier->send(new Notification('Merci pour votre commentaire. Celui-ci sera visible après modération.', ['browser']));

            return $this->redirectToRoute('conference_show', ['slug' => $conference->getSlug()]);
        }

        if ($form->isSubmitted()) {
            $notifier->send(new Notification('Pouvez-vous vérifier votre commentaire ? Il y a un problème avec.', ['browser']));
        }

        $offset = max(0, $request->query->getInt('offset'));
        $paginator = $commentRepository->getCommentPaginator($conference, $offset);

        return new Response($this->twig->render('conference/show.html.twig', [
            'conference' => $conference,
            'comment_form' => $form->createView(),
            'comments' => $paginator,
            'previous' => $offset - CommentRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + CommentRepository::PAGINATOR_PER_PAGE),
        ]));
    }
}
