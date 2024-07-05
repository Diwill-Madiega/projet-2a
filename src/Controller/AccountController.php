<?php

// src/Controller/AccountController.php

namespace App\Controller;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use App\Form\ChangePasswordType;
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
        $form = $this->createForm(ChangePasswordType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();
            if ($plainPassword) {
                $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
                $user->setPassword($hashedPassword);
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('Succès', "Mot de passe modifié avec succès!");

                return $this->redirectToRoute('app_my_account');
            }
        }

        return $this->render('account/my_account.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
}
