<?php

namespace App\Command;

use App\Repository\CommentRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CommentCleanupCommand extends Command
{
    private $commentRepository;

    protected static $defaultName = 'app:comment:cleanup';

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Supprime de la base de données les commentaires rejetés et jugés comme Spam.')
            ->addOption('dry-run', null, InputOption::VALUE_NONE, 'Dry run')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if ($input->getOption('dry-run')) {
            $io->note('Dry run activé.');

            $count = $this->commentRepository->countOldRejected();
        } else {
            $countRejected = $this->commentRepository->countOldRejected();
            $response = $io->ask(printf('Valider la suppression de "%d" commentaires ?', $countRejected), 'no',
                function ($answer) {
                    return $answer;
                });

            if ('yes' === $response) {
                $count = $this->commentRepository->deleteOldRejected();
                $io->success(printf('Suppression de "%d" ancien(s) commentaire(s) (Spam ou Rejeté).', $count));
            } else {
                $io->success('Suppression annulée.');
            }
        }

        return 0;
    }
}
