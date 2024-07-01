<?php

namespace App\Controller;

use App\Entity\BuyOrderLine;
use App\Form\BuyOrderLineType;
use App\Repository\BuyOrderLineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/order/sell/line')]
class BuyOrderLineController extends AbstractController
{
    #[Route('/', name: 'app_buy_order_line_index', methods: ['GET'])]
    public function index(BuyOrderLineRepository $buyOrderLineRepository): Response
    {
        return $this->render('buy_order_line/index.html.twig', [
            'buy_order_lines' => $buyOrderLineRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_buy_order_line_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $buyOrderLine = new BuyOrderLine();
        $form = $this->createForm(BuyOrderLineType::class, $buyOrderLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($buyOrderLine);
            $entityManager->flush();

            return $this->redirectToRoute('app_buy_order_line_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('buy_order_line/new.html.twig', [
            'buy_order_line' => $buyOrderLine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_buy_order_line_show', methods: ['GET'])]
    public function show(BuyOrderLine $buyOrderLine): Response
    {
        return $this->render('buy_order_line/show.html.twig', [
            'buy_order_line' => $buyOrderLine,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_buy_order_line_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BuyOrderLine $buyOrderLine, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BuyOrderLineType::class, $buyOrderLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_buy_order_line_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('buy_order_line/edit.html.twig', [
            'buy_order_line' => $buyOrderLine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_buy_order_line_delete', methods: ['POST'])]
    public function delete(Request $request, BuyOrderLine $buyOrderLine, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$buyOrderLine->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($buyOrderLine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_buy_order_line_index', [], Response::HTTP_SEE_OTHER);
    }
}
