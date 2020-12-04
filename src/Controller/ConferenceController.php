<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Conference;
use App\Form\CommentFormType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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

    public function __construct(Environment $twig, EntityManagerInterface $em)
    {
        $this->twig = $twig;
        $this->em = $em;
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
        return new Response($this->twig->render('conference/index.html.twig', [
       ]));
    }

    /**
     * @Route("/conference/{slug}", name="conference_show")
     *
     * @param Request $request
     * @param Conference $conference
     * @param CommentRepository $commentRepository
     * @param string $photoDir
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws Exception
     */
    public function show(Request $request, Conference $conference, CommentRepository $commentRepository, string $photoDir): Response
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

            return $this->redirectToRoute('conference_show', ['slug' => $conference->getSlug()]);
        }

        $offset = max(0, $request->query->getInt('offset', 0));
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
