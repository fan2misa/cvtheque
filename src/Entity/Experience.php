<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExperienceRepository")
 */
class Experience {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ExperienceInformationsGenerales", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $informationsGenerales;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="experiences")
     */
    private $entreprise;

    public function getId() {
        return $this->id;
    }

    public function getInformationsGenerales(): ?ExperienceInformationsGenerales
    {
        return $this->informationsGenerales;
    }

    public function setInformationsGenerales(ExperienceInformationsGenerales $informationsGenerales): self
    {
        $this->informationsGenerales = $informationsGenerales;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

}
