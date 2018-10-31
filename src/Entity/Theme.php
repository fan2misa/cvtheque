<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ThemeRepository")
 * @ORM\EntityListeners({"App\EventListener\ThemeListener"})
 */
class Theme
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     *
     */
    private $avatarCropped;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $templatePath;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cssPath;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getAvatarCropped(): ?string
    {
        return $this->avatarCropped;
    }

    public function setAvatarCropped(?string $avatarCropped): self
    {
        $this->avatarCropped = $avatarCropped;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCssPath(): ?string
    {
        return $this->cssPath;
    }

    public function setCssPath(?string $cssPath): self
    {
        $this->cssPath = $cssPath;

        return $this;
    }

    public function getCssPathGlobal(): ?string
    {
        return null !== $this->getCssPath() ? $this->getCssPath() . '/theme.css' : null;
    }

    public function getCssPathEdition(): ?string
    {
        return null !== $this->getCssPath() ? $this->getCssPath() . '/theme-edition.css' : null;
    }

    public function getCssPathVidualisation(): ?string
    {
        return null !== $this->getCssPath() ? $this->getCssPath() . '/theme-visualisation.css' : null;
    }

    public function getTemplatePath(): ?string
    {
        return $this->templatePath;
    }

    public function getTemplatePathEdition(): ?string
    {
        return null !== $this->getTemplatePath() ? $this->getTemplatePath() . '/edition.html.twig' : null;
    }

    public function getTemplatePathVisualisation(): ?string
    {
        return null !== $this->getTemplatePath() ? $this->getTemplatePath() . '/visualisation.html.twig' : null;
    }

    public function setTemplatePath(?string $templatePath): self
    {
        $this->templatePath = $templatePath;

        return $this;
    }
}
