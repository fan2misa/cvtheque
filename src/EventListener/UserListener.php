<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Bundle\MakerBundle\Str;

class UserListener
{

    public function prePersist(User $user, LifecycleEventArgs $event)
    {
        $user->setSlug(Str::asCommand($user->getPrenom()) . '.' . Str::asCommand($user->getNom()));
    }
}