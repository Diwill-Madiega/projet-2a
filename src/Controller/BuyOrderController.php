<?php

namespace App\Controller;

use App\Entity\BuyOrder;
use App\Form\BuyOrderType;
use App\Repository\BuyOrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/buy/order')]
class BuyOrderController extends AbstractController
{
    #[Route('/', name: 'app_buy_order_index', methods: ['GET'])]
    public function index(BuyOrderRepository $buyOrderRepository, Request $request): Response
    {
        $search = $request->query->get('search');
        $buyOrders = $buyOrderRepository->findBySearch($search);

        $user = $this->getUser();

        return $this->render('buy_order/index.html.twig', [
            'buy_orders' => $buyOrders,
            'user' => $user,
        ]);
    }

    #[Route('/new', name: 'app_buy_order_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $buyOrder = new BuyOrder();
        $form = $this->createForm(BuyOrderType::class, $buyOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($buyOrder);
            $entityManager->flush();

            return $this->redirectToRoute('app_buy_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('buy_order/new.html.twig', [
            'buy_order' => $buyOrder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_buy_order_show', methods: ['GET'])]
    public function show(BuyOrder $buyOrder): Response
    {
        return $this->render('buy_order/show.html.twig', [
            'buy_order' => $buyOrder,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_buy_order_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BuyOrder $buyOrder, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BuyOrderType::class, $buyOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_buy_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('buy_order/edit.html.twig', [
            'buy_order' => $buyOrder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_buy_order_delete', methods: ['POST'])]
    public function delete(Request $request, BuyOrder $buyOrder, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$buyOrder->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($buyOrder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_buy_order_index', [], Response::HTTP_SEE_OTHER);
    }
}
