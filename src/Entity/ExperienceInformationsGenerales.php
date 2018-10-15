<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExperienceInformationsGeneralesRepository")
 */
class ExperienceInformationsGenerales {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $intitulePoste;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateFin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enCours;

    public function __construct() {
        $this->enCours = false;
    }

    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @return string
     */
    public function getIntitulePoste() {
        return $this->intitulePoste;
    }

    /**
     * 
     * @param string $intitulePoste
     * @return \self
     */
    public function setIntitulePoste($intitulePoste): self {
        $this->intitulePoste = $intitulePoste;

        return $this;
    }

    /**
     * 
     * @return \DateTimeInterface
     */
    public function getDateDebut() {
        return $this->dateDebut;
    }

    /**
     * 
     * @param \DateTimeInterface $dateDebut
     * @return \self
     */
    public function setDateDebut($dateDebut): self {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * 
     * @return \DateTimeInterface
     */
    public function getDateFin() {
        return $this->dateFin;
    }

    /**
     * 
     * @param \DateTimeInterface $dateFin
     * @return \self
     */
    public function setDateFin($dateFin): self {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * 
     * @return bool
     */
    public function enCours() {
        return $this->enCours;
    }

    /**
     * 
     * @param bool $enCours
     * @return \self
     */
    public function setEnCours($enCours): self {
        $this->enCours = $enCours;

        return $this;
    }

}
