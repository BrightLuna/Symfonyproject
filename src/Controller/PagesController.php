<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\DiscordService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PagesController extends AbstractController
{

    #[Route('/', name: 'page.home')]
    public function home(): Response
    {
        return $this->render('pages/home.html.twig');
    }

    #[Route('/test', name: 'page.test')]
    public function test(UserRepository $users, DiscordService $discord): Response
    {
        $invitationLink = $discord->getDiscordInvitationLink();
        return $this->render('pages/test.html.twig', [
            'users' => $users->findAll(),
            'discordLink' => $invitationLink
        ]);
    }

    #[Route('/success', name: 'page.success')]
    public function success(): Response
    {
        return $this->render('pages/success.html.twig');
    }

}
