<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\DiscordService;
use App\Service\FiveMServerService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PagesController extends AbstractController
{

    #[Route('/', name: 'page.home')]
    public function home(DiscordService $discord): Response
    {
        // Invitation Link for your server discord
        $invitationLink = $discord->getDiscordInvitationLink();
        $discordUsers = $discord->getServerUserCount();
        return $this->render('pages/home.html.twig', [
            'discordLink' => $invitationLink,
            'discordUsers' => $discordUsers
        ]);
    }

    #[Route('/test', name: 'page.test')]
    public function test(UserRepository $users): Response
    {
        return $this->render('pages/test.html.twig', [
            'users' => $users->findAll()
        ]);
    }

    #[Route('/success', name: 'page.success')]
    public function success(): Response
    {
        return $this->render('pages/success.html.twig');
    }

}
