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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CV", inversedBy="experiences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cv;

    /**
     * @ORM\Column(type="TypeContratEnumType")
     * @Fresh\DoctrineEnumBundle\Validator\Constraints\Enum(entity="App\DBAL\Types\TypeContratEnumType")
     */
    private $typeContrat;

    public function getId() {
        return $this->id;
    }

    public function getInformationsGenerales(): ExperienceInformationsGenerales {
        return $this->informationsGenerales;
    }

    public function setInformationsGenerales(ExperienceInformationsGenerales $informationsGenerales): self {
        $this->informationsGenerales = $informationsGenerales;

        return $this;
    }

    public function getEntreprise() {
        return $this->entreprise;
    }

    public function setEntreprise($entreprise): self {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getCv() {
        return $this->cv;
    }

    public function setCv($cv): self {
        $this->cv = $cv;

        return $this;
    }

    public function getTypeContrat() {
        return $this->typeContrat;
    }

    public function setTypeContrat(string $typeContrat): self {
        $this->typeContrat = $typeContrat;

        return $this;
    }

}
