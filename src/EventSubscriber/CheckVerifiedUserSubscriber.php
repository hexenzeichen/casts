<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Security\AccountNotVerifiedAuthenticationException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\CheckPassportEvent;
use Symfony\Component\Security\Http\Event\LoginFailureEvent;

class CheckVerifiedUserSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            CheckPassportEvent::class => ['onCheckPassport', -10],
            LoginFailureEvent::class => 'onLoginFailure',
        ];
    }

    public function onCheckPassport(CheckPassportEvent $event)
    {
        $passport = $event->getPassport();
        $user = $passport->getUser();
        if (!$user instanceof User) {
            throw new \Exception('Unexpected user type');
        }
        if (!$user->isVerified()) {
//            throw new AccountNotVerifiedAuthenticationException();
        }
    }

    public function onLoginFailure(LoginFailureEvent $event)
    {
        // TODO do nothing
    }
}
