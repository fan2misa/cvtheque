<?php

namespace App\Service;

use App\Entity\CV;
use App\Entity\Experience;
use Doctrine\Bundle\DoctrineBundle\Registry;

/**
 * Description of CVService
 *
 * @author gjean
 */
class CVService {

    private $doctrine;

    public function __construct(Registry $doctrine) {
        $this->doctrine = $doctrine;
    }

    public function save(CV $cv) {
        $this->doctrine->getManager()->persist($cv);
        $this->doctrine->getManager()->flush();
    }

    public function getAvatar(CV $cv) {
        return $cv->getAvatarPath() ? $cv->getUser()->getAvatarPath() : "https://dummyimage.com/200x250/ecf0f1/7f8c8d";
    }

    public function getExperiencePeriode(Experience $experience) {
        if ($experience->getInformationsGenerales()->enCours()) {
            return "Depuis le " . $experience->getInformationsGenerales()->getDateDebut()->format('d/m/Y');
        } else {
            return "Du " . $experience->getInformationsGenerales()->getDateDebut()->format('d/m/Y') . " au " . $experience->getInformationsGenerales()->getDateFin()->format('d/m/Y');
        }
    }
}
