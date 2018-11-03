<?php

namespace App\PartageResponse;

use App\Entity\Cv;
use App\Service\PartageResponseInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;

class HtmlPartageResponse implements PartageResponseInterface {

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
