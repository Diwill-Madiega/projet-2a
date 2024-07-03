<?php

namespace App\Controller;

use App\Entity\DevisLine;
use App\Form\DevisLineType;
use App\Repository\DevisLineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/devisline')]
class DevisLineController extends AbstractController
{
    #[Route('/', name: 'app_devis_line_index', methods: ['GET'])]
    public function index(DevisLineRepository $devisLineRepository): Response
    {
        return $this->render('devis_line/index.html.twig', [
            'devis_lines' => $devisLineRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_devis_line_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $devisLine = new DevisLine();
        $form = $this->createForm(DevisLineType::class, $devisLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($devisLine);
            $entityManager->flush();

            return $this->redirectToRoute('app_devis_line_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('devis_line/new.html.twig', [
            'devis_line' => $devisLine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devis_line_show', methods: ['GET'])]
    public function show(DevisLine $devisLine): Response
    {
        return $this->render('devis_line/show.html.twig', [
            'devis_line' => $devisLine,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_devis_line_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DevisLine $devisLine, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DevisLineType::class, $devisLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_devis_line_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('devis_line/edit.html.twig', [
            'devis_line' => $devisLine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devis_line_delete', methods: ['POST'])]
    public function delete(Request $request, DevisLine $devisLine, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devisLine->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($devisLine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_devis_line_index', [], Response::HTTP_SEE_OTHER);
    }
}
