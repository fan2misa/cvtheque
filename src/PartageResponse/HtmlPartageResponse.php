<?php

namespace App\PartageResponse;

use App\Service\Wrapper\Entity\Cv;
use App\Service\PartageResponse;
use Symfony\Component\HttpFoundation\Response;

class HtmlPartageResponse extends PartageResponse {

    public function render(Cv $cv)
    {
        $content = $this->templating->render($this->getTemplate($cv), [
            'cv' => $cv
        ]);

        $response = new Response();
        $response->setContent($content);
        return $response;
    }


    protected function getExtension()
    {
        return 'html';
    }
}
