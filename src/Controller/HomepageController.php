<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class HomepageController extends AbstractController
{
    #[Route('/home', name: 'homepage')]
    public function indexHome(?UserInterface $user): Response
    {
        return $this->render('homepage/index.html.twig', [
            'user' => $user,
        ]);
    }
}
