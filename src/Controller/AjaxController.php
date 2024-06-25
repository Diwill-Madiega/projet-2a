<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Machine;

class AjaxController extends AbstractController
{
    /**
     * @Route("/ajax/get-machines-by-post", name="ajax_get_machines_by_post", methods={"POST"})
     */
    public function getMachinesByPost(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $postId = $data['post_id'];


        $machines = $this->getDoctrine()->getRepository(Machine::class)->findBy(['post' => $postId]);

        $responseData = [];
        foreach ($machines as $machine) {
            $responseData[] = [
                'id' => $machine->getId(),
                'name' => $machine->getName(),
            ];
        }

        return $this->json($responseData);
    }
}