<?php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class UserController extends BaseController
{

    /**
     * @Route("/api/me")
     * @IsGranted("IS_AUTHENTICATED_REMEMBERED")
     */
    #[Route('/api/me', name: 'me')]
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    public function apiMe()
    {
        return $this->json($this->getUser(), 200, [], [
            'groups' => ['user:read']
        ]);
    }
}
