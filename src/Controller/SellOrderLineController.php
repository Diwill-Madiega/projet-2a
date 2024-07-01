<?php

namespace App\Controller;

use App\Entity\SellOrderLine;
use App\Form\SellOrderLineType;
use App\Repository\SellOrderLineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sellorder/line')]
class SellOrderLineController extends AbstractController
{
    #[Route('/', name: 'app_sell_order_line_index', methods: ['GET'])]
    public function index(SellOrderLineRepository $sellOrderLineRepository): Response
    {
        return $this->render('sell_order_line/index.html.twig', [
            'sell_order_lines' => $sellOrderLineRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sell_order_line_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sellOrderLine = new SellOrderLine();
        $form = $this->createForm(SellOrderLineType::class, $sellOrderLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sellOrderLine);
            $entityManager->flush();

            return $this->redirectToRoute('app_sell_order_line_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sell_order_line/new.html.twig', [
            'sell_order_line' => $sellOrderLine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sell_order_line_show', methods: ['GET'])]
    public function show(SellOrderLine $sellOrderLine): Response
    {
        return $this->render('sell_order_line/show.html.twig', [
            'sell_order_line' => $sellOrderLine,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sell_order_line_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SellOrderLine $sellOrderLine, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SellOrderLineType::class, $sellOrderLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_sell_order_line_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sell_order_line/edit.html.twig', [
            'sell_order_line' => $sellOrderLine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sell_order_line_delete', methods: ['POST'])]
    public function delete(Request $request, SellOrderLine $sellOrderLine, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sellOrderLine->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($sellOrderLine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_sell_order_line_index', [], Response::HTTP_SEE_OTHER);
    }
}
