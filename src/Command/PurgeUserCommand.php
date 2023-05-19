<?php

namespace App\Command;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

#[AsCommand(
    name: 'v:purge-user',
    description: 'Add a short description for your command',
)]
class PurgeUserCommand extends Command
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UserRepository
     */
    private $users;

    public function __construct(EntityManagerInterface $entityManager, UserRepository $users)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->users = $users;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Remove all Users from database [DEV TOOL]')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $usersCount = 0;

        while ($users = $this->users->findAll()) {
            foreach($users as $user) 
            {
                $this->entityManager->remove($user); // Delete users on cascade
                $this->entityManager->flush(); // Executes all deletions
                $this->entityManager->clear(); // Detaches all object from Doctrine
                $usersCount += count($users); // Count all deletions
            }
        }

        if ($usersCount) {
            $io->success("[V Symfony] $usersCount users(s) have been deleted.");
        } else {
            $io->error('[V Symfony] No users in database.');
        }

        return Command::SUCCESS;
    }
}
