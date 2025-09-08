<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(
        StarshipRepository $starshipRepository,
        Request $request,
    ): Response {
        $ships = $starshipRepository->findIncomplete();
        $ships->setMaxPerPage(5);
        $ships->setCurrentPage((int) $request->query->get('page', 1));

        $myShip = $starshipRepository->findMyShip();

        return $this->render('main/homepage.html.twig',
            [
                'myShip' => $myShip,
                'ships' => $ships,
            ]);
    }
}
