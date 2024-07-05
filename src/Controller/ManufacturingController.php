<?php

namespace App\Controller;

use App\Entity\Piece;
use App\Entity\Production;
use App\Entity\Post;
use App\Entity\Machine;
use App\Form\ManufacturingType;
use App\Form\ProductionType;
use App\Repository\PostRepository;
use App\Repository\MachineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/manufacturing')]
class ManufacturingController extends AbstractController
{
    #[Route('/', name: 'app_manufacturing_index', methods: ['GET'])]
    public function index(Request $request, EntityManagerInterface $entityManager, PostRepository $postRepository, MachineRepository $machineRepository): Response
    {
        $pieceId = $request->get('piece');
        $machines = $machineRepository->findAll();

        $piece = $entityManager->getRepository(Piece::class)->find($pieceId);

        if (!$piece) {
            throw $this->createNotFoundException("La pièce n'existe pas.");
        }

        $user = $this->getUser();

        $qualifiedPosts = $user->getQualification()->toArray();

        return $this->render('manufacturing/index.html.twig', [
            'piece' => $piece,
            'qualifiedPosts' => $qualifiedPosts,
            'machines' => $machines,
        ]);
    }

    #[Route('/new', name: 'app_manufacturing_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $manufacturing = new Production();
        $form = $this->createForm(ProductionType::class, $manufacturing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($manufacturing);
            $entityManager->flush();

            return $this->redirectToRoute('app_manufacturing_index', [], Response::HTTP_SEE_OTHER);
        }

        $user = $this->getUser();

        return $this->render('production/new.html.twig', [
            'manufacturing' => $manufacturing,
            'form' => $form->createView(),
            'user' => $user, 
        ]);
    }
}
