<?php

namespace App\Controller;

use App\Repository\StarshipPartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class PartController extends AbstractController
{
    #[Route('/part', name: 'app_part_index')]
    #[IsGranted('ROLE_USER')]
    public function index(StarshipPartRepository $repository, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $query = $request->query->get('query');
        $parts = $repository->findAllOrderedByPrice($query);
        return $this->render('part/index.html.twig', [
            'parts' => $parts
        ]);
    }
}
