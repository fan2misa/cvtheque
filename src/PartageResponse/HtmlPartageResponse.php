<?php

namespace App\PartageResponse;

use App\Service\Wrapper\Entity\Cv;
use App\Service\PartageResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;

class HtmlPartageResponse extends PartageResponse {

    private $templating;

    public function __construct(Twig_Environment $templating)
    {
        $this->templating = $templating;
    }

    public function render(Cv $cv)
    {
        $content = $this->templating->render($cv->getTheme()->getTemplatePathVisualisation(), [
            'cv' => $cv
        ]);

        $response = new Response();
        $response->setContent($content);
        return $response;
    }
}
