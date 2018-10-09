<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CVRepository")
 */
class CV {

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
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $situationProfessionnelle;

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $disponibilite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="cvs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom(string $nom): self {
        $this->nom = $nom;

        return $this;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function setAvatar($avatar): self {
        $this->avatar = $avatar;

        return $this;
    }

    public function getSituationProfessionnelle() {
        return $this->situationProfessionnelle;
    }

    public function setSituationProfessionnelle(array $situationProfessionnelle): self {
        $this->situationProfessionnelle = $situationProfessionnelle;

        return $this;
    }

    public function getDisponibilite() {
        return $this->disponibilite;
    }

    public function setDisponibilite(array $disponibilite): self {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user): self {
        $this->user = $user;

        return $this;
    }

}
