<?php

namespace App\Service\Wrapper;

use App\Entity\Cv;
use App\Service\CVService;

class CvWrapperService {

    private $cvService;

    private $userWrapperService;

    private $themeWrapperService;

    public function __construct(CVService $cvService, UserWrapperService $userWrapperService, ThemeWrapperService $themeWrapperService)
    {
        $this->cvService = $cvService;
        $this->userWrapperService = $userWrapperService;
        $this->themeWrapperService = $themeWrapperService;
    }

    public function generateWrapper(Cv $cv, $extension)
    {
        $cvWrapper = new \App\Service\Wrapper\Entity\Cv();

        $cvWrapper
            ->setNom($cv->getNom())
            ->setAvatar($this->cvService->getAvatar($cv))
            ->setSituationProfessionnelle($cv->getSituationProfessionnelle())
            ->setDisponibilite($cv->getDisponibilite())
            ->setContacts($cv->getContacts())
            ->setFormations($cv->getFormations())
            ->setExperiences($cv->getExperiences())
            ->setDomainesCompetence($cv->getDomainesCompetence())
            ->setUser($this->userWrapperService->generateWrapper($cv->getUser(), $extension))
            ->setTheme($this->themeWrapperService->generateWrapper($cv->getTheme(), $extension))
        ;

        return $cvWrapper;
    }

}
