<?php

namespace App\Service;

use App\Entity\CV;

/**
 * Description of CVService
 *
 * @author gjean
 */
class CVService {
    
    public function __construct() {
        
    }

    public function getAvatar(CV $cv) {
        return $cv->getAvatarPath()
                ? $user->getAvatarPath()
                : "https://dummyimage.com/200x250/ecf0f1/7f8c8d";
    }
}
