<?php

namespace App\Twig;

use App\Service\CVService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CVExtension extends AbstractExtension {

    private $cvService;

    public function __construct(CVService $cvService) {
        $this->cvService = $cvService;
    }

    public function getFunctions(): array {
        return [
            new TwigFunction('experience_periode', [$this->cvService, 'getExperiencePeriode'], ['is_safe' => ['html']]),
            new TwigFunction('formation_periode', [$this->cvService, 'getFormationPeriode'], ['is_safe' => ['html']]),
        ];
    }

}
