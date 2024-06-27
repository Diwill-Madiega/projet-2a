<?php

namespace App\Controller;

use App\Entity\Furnisher;
use App\Form\FurnisherType;
use App\Repository\FurnisherRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/furnisher')]
class FurnisherController extends AbstractController
{
    #[Route('/', name: 'app_furnisher_index', methods: ['GET'])]
    public function index(FurnisherRepository $furnisherRepository, Request $request): Response
    {
        $search = $request->query->get('search');
        $furnishers = $furnisherRepository->findBySearch($search);

        $user = $this->getUser();

        return $this->render('furnisher/index.html.twig', [
            'furnishers' => $furnishers,
            'user' => $user,
        ]);
    }

    #[Route('/new', name: 'app_furnisher_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $furnisher = new Furnisher();
        $form = $this->createForm(FurnisherType::class, $furnisher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($furnisher);
            $entityManager->flush();

            return $this->redirectToRoute('app_furnisher_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('furnisher/new.html.twig', [
            'furnisher' => $furnisher,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_furnisher_show', methods: ['GET'])]
    public function show(Furnisher $furnisher): Response
    {
        return $this->render('furnisher/show.html.twig', [
            'furnisher' => $furnisher,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_furnisher_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Furnisher $furnisher, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FurnisherType::class, $furnisher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_furnisher_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('furnisher/edit.html.twig', [
            'furnisher' => $furnisher,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_furnisher_delete', methods: ['POST'])]
    public function delete(Request $request, Furnisher $furnisher, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$furnisher->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($furnisher);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_furnisher_index', [], Response::HTTP_SEE_OTHER);
    }
}
