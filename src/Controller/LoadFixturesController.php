<?php

// src/Controller/LoadFixturesController.php

namespace App\Controller;

use App\DataFixtures\UserFixtures;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoadFixturesController extends AbstractController
{
    /**
     * @Route("/load_fixtures", name="load_fixtures")
     */
    public function loadFixtures(EntityManagerInterface $entityManager, UserFixtures $userFixtures): Response
    {
        // Run the fixtures loading logic
        $userFixtures->load($entityManager);

        // Optionally, you can add a message or redirect after loading fixtures
        $this->addFlash('success', 'Fixtures loaded successfully!');

        // Redirect to homepage or any other route after loading fixtures
        return $this->redirectToRoute('app_homepage');
    }
}
