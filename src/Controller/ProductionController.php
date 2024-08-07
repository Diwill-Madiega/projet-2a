<?php

namespace App\Controller;

use App\Entity\Production;
use App\Form\ProductionType;
use App\Repository\ProductionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/production')]
class ProductionController extends AbstractController
{
    #[Route('/', name: 'app_production_index', methods: ['GET'])]
    public function index(ProductionRepository $productionRepository, Request $request): Response
    {
        $search = $request->query->get('search');
        $productions = $productionRepository->findBySearch($search);

        return $this->render('production/index.html.twig', [
            'productions' => $productions,
        ]);
    }

    #[Route('/new', name: 'app_production_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $production = new Production();
        $form = $this->createForm(ProductionType::class, $production);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($production);
            $entityManager->flush();
            $this->addFlash('Succès', "Réalisation créée avec succès!");
            return $this->redirectToRoute('app_production_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('production/new.html.twig', [
            'production' => $production,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_production_show', methods: ['GET'])]
    public function show(Production $production): Response
    {
        return $this->render('production/show.html.twig', [
            'production' => $production,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_production_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Production $production, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductionType::class, $production);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('Succès', "Réalisation modifiée avec succès!");
            return $this->redirectToRoute('app_production_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('production/edit.html.twig', [
            'production' => $production,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_production_delete', methods: ['POST'])]
    public function delete(Request $request, Production $production, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$production->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($production);
            $entityManager->flush();
            $this->addFlash('Succès', "Réalisation supprimée avec succès!");
        }

        return $this->redirectToRoute('app_production_index', [], Response::HTTP_SEE_OTHER);
    }
}
