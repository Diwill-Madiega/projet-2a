<?php

// src/Controller/AccountController.php

namespace App\Controller;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class AccountController extends AbstractController
{
    #[Route('/my-account', name: 'app_my_account', methods: ['GET', 'POST'])]
    public function myAccount(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        
        // Handle form submission
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the new password, if provided
            $plainPassword = $form->get('password')->getData();
            if ($plainPassword) {
                $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
                $user->setPassword($hashedPassword);
            }
            $entityManager->persist($user);
            $entityManager->flush();

            // Add a flash message for success
            $this->addFlash('Succès', "Mot de passe modifié avec succès!");

            // Redirect back to the same page to avoid form resubmission
            return $this->redirectToRoute('app_my_account');
        }

        return $this->render('account/my_account.html.twig', [
            'form' => $form->createView(),
            'user' => $user, // Pass the user object to the template
        ]);
    }
}
