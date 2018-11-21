<?php

namespace App\Service\Wrapper\Entity;

class Theme {

    private $templatePath;

    private $publicPath;

    /**
     * @return null|string
     */
    public function getTemplatePath()
    {
        return $this->templatePath;
    }

    /**
     * @param mixed $templatePath
     * @return Theme
     */
    public function setTemplatePath($templatePath)
    {
        $this->templatePath = $templatePath;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getTemplatePathVisualisation(?string $extension = null): ?string
    {
        return null !== $this->getTemplatePath() ? $this->getTemplatePath() . '/visualisation' . (null !== $extension ? '-' . $extension : '') . '.html.twig' : null;
    }

    /**
     * @return null|string
     */
    public function getPublicPath()
    {
        return $this->publicPath;
    }

    /**
     * @param mixed $publicPath
     * @return Theme
     */
    public function setPublicPath($publicPath)
    {
        $this->publicPath = $publicPath;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCssPathGlobal(): ?string
    {
        return null !== $this->getPublicPath() ? $this->getPublicPath() . '/css/theme.css' : null;
    }

    /**
     * @return null|string
     */
    public function getCssPathEdition(): ?string
    {
        return null !== $this->getPublicPath() ? $this->getPublicPath() . '/css/theme-edition.css' : null;
    }

    /**
     * @return null|string
     */
    public function getCssPathVisualisation(?string $extension = null): ?string
    {
        return null !== $this->getPublicPath() ? $this->getPublicPath() . '/css/theme-visualisation' . (null !== $extension ? '-' . $extension : '') . '.css' : null;
    }

}
