<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ThemeRepository")
 * @ORM\EntityListeners({"App\EventListener\ThemeListener"})
 * @UniqueEntity("slug")
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
    private $publicPath;

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

    public function getPublicPath(): ?string
    {
        return $this->publicPath;
    }

    public function setPublicPath(?string $publicPath): self
    {
        $this->publicPath = $publicPath;

        return $this;
    }

    public function getCssPathGlobal(): ?string
    {
        return null !== $this->getPublicPath() ? $this->getPublicPath() . '/css/theme.css' : null;
    }

    public function getCssPathEdition(): ?string
    {
        return null !== $this->getPublicPath() ? $this->getPublicPath() . '/css/theme-edition.css' : null;
    }

    public function getCssPathVisualisation(): ?string
    {
        return null !== $this->getPublicPath() ? $this->getPublicPath() . '/css/theme-visualisation.css' : null;
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
