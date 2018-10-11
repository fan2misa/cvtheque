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

    public function getId() {
        return $this->id;
    }

    public function getIntitulePoste() {
        return $this->intitulePoste;
    }

    public function setIntitulePoste(string $intitulePoste): self {
        $this->intitulePoste = $intitulePoste;

        return $this;
    }

    public function getDateDebut() {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin() {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function enCours() {
        return $this->enCours;
    }

    public function setEnCours(bool $enCours): self {
        $this->enCours = $enCours;

        return $this;
    }

}
