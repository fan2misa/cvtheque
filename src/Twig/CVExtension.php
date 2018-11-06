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
            new TwigFunction('has_custom_template_edition', [$this->cvService, 'hasCustomTemplateEdition']),
            new TwigFunction('get_template_path', [$this->cvService, 'getTemplatePath']),
            new TwigFunction('get_template_edition', [$this->cvService, 'getTemplateEdition']),
            new TwigFunction('experience_periode', [$this->cvService, 'getExperiencePeriode'], ['is_safe' => ['html']]),
            new TwigFunction('formation_periode', [$this->cvService, 'getFormationPeriode'], ['is_safe' => ['html']]),
        ];
    }

}
