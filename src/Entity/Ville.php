<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */
class Ville {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $codePostal;

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom): self {
        $this->nom = $nom;

        return $this;
    }

    public function getPays() {
        return $this->pays;
    }

    public function setPays($pays): self {
        $this->pays = $pays;

        return $this;
    }

    public function getCodePostal() {
        return $this->codePostal;
    }

    public function setCodePostal($codePostal): self {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function __toString() {
        return $this->nom;
    }
}
