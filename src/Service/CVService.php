<?php

namespace App\Service;

use App\Entity\CV;
use App\Entity\Experience;

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
    
    public function getExperiencePeriode(Experience $experience) {
        if ($experience->getInformationsGenerales()->enCours()) {
            return "Depuis le " . $experience->getInformationsGenerales()->getDateDebut()->format('d/m/Y');
        } else {
            return "Du " . $experience->getInformationsGenerales()->getDateDebut()->format('d/m/Y') . " au " . $experience->getInformationsGenerales()->getDateFin()->format('d/m/Y');
        }
    }
}
