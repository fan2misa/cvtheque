<?php

namespace App\Service\Wrapper;

use App\Entity\User;

class UserWrapperService {

    public function generateWrapper(User $user)
    {
        $userWrapper = new \App\Service\Wrapper\Entity\User();

        return $userWrapper;
    }

}
