<?php

namespace App\Service\Wrapper;

use App\Entity\User;

class UserWrapperService {

    public function generateWrapper(User $user, $extension)
    {
        $userWrapper = new \App\Service\Wrapper\Entity\User();

        $userWrapper
            ->setNom($user->getNom())
            ->setPrenom($user->getPrenom())
            ->setEmail($user->getEmail())
            ->setDateAnniversaire($user->getDateAnniversaire())
        ;

        return $userWrapper;
    }

}
