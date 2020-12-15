<?php

namespace App\MessageHandler;

use App\Message\CommentMessage;
use App\Repository\CommentRepository;
use App\SpamChecker;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Workflow\WorkflowInterface;

class CommentMessageHandler implements MessageHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var SpamChecker
     */
    private $spamChecker;
    /**
     * @var CommentRepository
     */
    private $commentRepository;
    /**
     * @var MessageBusInterface
     */
    private $bus;
    /**
     * @var WorkflowInterface
     */
    private $workflow;
    /**
     * @var LoggerInterface|null
     */
    private $logger;
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var string
     */
    private $adminMail;

    public function __construct(EntityManagerInterface $entityManager, SpamChecker $spamChecker,
                                CommentRepository $commentRepository, MessageBusInterface $bus,
                                WorkflowInterface $commentStateMachine, MailerInterface $mailer,
                                string $adminMail, LoggerInterface $logger = null)
    {
        $this->entityManager = $entityManager;
        $this->spamChecker = $spamChecker;
        $this->commentRepository = $commentRepository;
        $this->bus = $bus;
        $this->workflow = $commentStateMachine;
        $this->mailer = $mailer;
        $this->adminMail = $adminMail;
        $this->logger = $logger;
    }

    public function __invoke(CommentMessage $message)
    {
        $comment = $this->commentRepository->find($message->getId());
        if (!$comment) {
            return;
        }

        if ($this->workflow->can($comment, 'accept')) {
            $score = $this->spamChecker->getSpamScore($comment, $message->getContext());
            $transition = 'accept';

            if (2 === $score) {
                $transition = 'reject_spam';
            } elseif (1 === $score) {
                $transition = 'might_be_spam';
            }
            $this->workflow->apply($comment, $transition);
            $this->entityManager->flush();

            $this->bus->dispatch($message);
        } elseif ($this->workflow->can($comment, 'publish') || $this->workflow->can($comment, 'publish_ham')) {
            $this->mailer->send((new NotificationEmail())
                ->subject('Nouveau commentaire posté !')
                ->htmlTemplate('emails/comment_notification.html.twig')
                ->from($this->adminMail)
                ->to($this->adminMail)
                ->context(['comment' => $comment])
            );
        } elseif ($this->logger) {
            $this->logger->debug('Message de commentaire rejeté !', [
                'comment' => $comment->getId(),
                'state' => $comment->getState(),
            ]);
        }
    }
}