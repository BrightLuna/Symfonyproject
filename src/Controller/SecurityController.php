<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route(path: '/auth/login', name: 'auth.login')]
    public function login(): Response
    {
        return $this->redirectToRoute('page.home');
        //return $this->render('security/login.html.twig');
    }

    #[Route(path: '/auth/logout', name: 'auth.logout')]
    public function logout(): void
    {}
}
