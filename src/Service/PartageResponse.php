<?php

namespace App\Service;

use App\Service\Wrapper\Entity\Cv;

abstract class PartageResponse {

    protected $templating;

    protected $appPath;

    protected $publicPath;

    protected $templatePath;

    public function __construct(\Twig_Environment $templating, $app_path)
    {
        $this->templating = $templating;
        $this->appPath = $app_path;
        $this->publicPath = $this->appPath . '/public';
        $this->templatePath = $this->appPath . '/templates';
    }

    public abstract function render(Cv $cv);

    protected abstract function getExtension();

    protected function getTemplate(Cv $cv) {
        return file_exists($this->templatePath . '/' . $cv->getTheme()->getTemplatePathVisualisation($this->getExtension()))
            ? $cv->getTheme()->getTemplatePathVisualisation($this->getExtension())
            : $cv->getTheme()->getTemplatePathVisualisation();
    }

}