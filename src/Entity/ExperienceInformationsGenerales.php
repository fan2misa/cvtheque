<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExperienceInformationsGeneralesRepository")
 */
class ExperienceInformationsGenerales
{

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

    public function __construct()
    {
        $this->enCours = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     *
     * @return string
     */
    public function getIntitulePoste(): ?string
    {
        return $this->intitulePoste;
    }

    /**
     *
     * @param string $intitulePoste
     * @return \self
     */
    public function setIntitulePoste(string $intitulePoste): self
    {
        $this->intitulePoste = $intitulePoste;

        return $this;
    }

    /**
     *
     * @return \DateTimeInterface
     */
    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    /**
     *
     * @param \DateTimeInterface $dateDebut
     * @return \self
     */
    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     *
     * @return \DateTimeInterface
     */
    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    /**
     *
     * @param \DateTimeInterface $dateFin
     * @return \self
     */
    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     *
     * @return bool
     */
    public function enCours(): ?bool
    {
        return $this->enCours;
    }

    /**
     *
     * @param bool $enCours
     * @return \self
     */
    public function setEnCours(bool $enCours): self
    {
        $this->enCours = $enCours;

        return $this;
    }

}
