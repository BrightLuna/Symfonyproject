<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'v:set-admin',
    description: '[V Symfony] Set Admin with Steam ID',
)]
class SetAdminCommand extends Command
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
            ->addArgument('steamID', InputArgument::REQUIRED, 'Steam id Of User')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        $steamID = $input->getArgument('steamID');

        // Find the user by Steam ID
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['steamID' => $steamID]);

        if (!$user) {
            $io->error("[V Symfony] Steam ID: $steamID not exist, User not found");
            return Command::FAILURE;
        }

        // Change the user's role to ROLE_ADMIN
        $user->setRoles(['ROLE_ADMIN']);
        $username = $user->getUsername();
        $this->entityManager->flush();

        $io->success("[V Symfony] $username user, Role was change for Admin");
        return Command::SUCCESS;
    }
}
