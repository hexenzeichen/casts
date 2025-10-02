<?php

namespace App\Security\Voter;

use App\Entity\Starship;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Vote;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

final class ShipVoter extends Voter
{
    public const EDIT = 'POST_EDIT';
    public const VIEW = 'POST_VIEW';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, ['EDIT'])
            && $subject instanceof Starship;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token, ?Vote $vote = null): bool
    {
        /** @var User $user */
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        if (!$subject instanceof Starship) {
            throw new \Exception('Wrong type somehow passed');
        }
        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'EDIT':
                return true;
        }
        return false;
    }
}
