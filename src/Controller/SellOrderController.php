<?php

namespace App\Controller;

use App\Entity\SellOrder;
use App\Form\SellOrderType;
use App\Repository\DevisLineRepository;
use App\Repository\SellOrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

#[Route('/sell/order')]
class SellOrderController extends AbstractController
{
    #[Route('/', name: 'app_sell_order_index', methods: ['GET'])]
    public function index(SellOrderRepository $sellOrderRepository, Request $request): Response
    {
        $search = $request->query->get('search');
        $sellOrders = $sellOrderRepository->findBySearch($search);

        $user = $this->getUser();

        return $this->render('sell_order/index.html.twig', [
            'sell_orders' => $sellOrders,
            'user' => $user,
        ]);
    }

    #[Route('/new', name: 'app_sell_order_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sellOrder = new SellOrder();
        $form = $this->createForm(SellOrderType::class, $sellOrder);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($sellOrder->getDevisLines() as $devisLine) {
                $devisLine->addSellOrder($sellOrder);
            }
            $entityManager->persist($sellOrder);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_sell_order_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('sell_order/new.html.twig', [
            'sell_order' => $sellOrder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sell_order_show', methods: ['GET'])]
    public function show(SellOrder $sellOrder): Response
    {
        return $this->render('sell_order/show.html.twig', [
            'sell_order' => $sellOrder,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sell_order_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SellOrder $sellOrder, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SellOrderType::class, $sellOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_sell_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sell_order/edit.html.twig', [
            'sell_order' => $sellOrder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sell_order_delete', methods: ['POST'])]
    public function delete(Request $request, SellOrder $sellOrder, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $sellOrder->getId(), $request->request->get('_token'))) {
            $entityManager->remove($sellOrder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_sell_order_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/fetch-devis-lines', name: 'fetch_devis_lines', methods: ['GET'])]
    public function fetchDevisLines(): JsonResponse
    {
        $devisLines = $this->getDoctrine()->getRepository(DevisLine::class)->findAll();

        $devisLinesData = [];
        foreach ($devisLines as $devisLine) {
            $devisLinesData[] = [
                'id' => $devisLine->getId(),
                'name' => $devisLine->getName(),
                // Add other fields you want to include
            ];
        }

        return new JsonResponse($devisLinesData);
    }

}
