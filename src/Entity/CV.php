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
    private $avatarPath;

    /**
     * @ORM\Column(type="SituationProfessionnelleEnumType", nullable=true)
     */
    private $situationProfessionnelle;

    /**
     * @ORM\Column(type="DisponibiliteEnumType", nullable=true)
     */
    private $disponibilite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="cvs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Experience", mappedBy="cv", orphanRemoval=true, cascade={"persist"})
     */
    private $experiences;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CompetenceDomaine", mappedBy="cv", orphanRemoval=true, cascade={"persist"})
     */
    private $domainesCompetence;

    public function __construct() {
        $this->experiences = new ArrayCollection();
        $this->domainesCompetence = new ArrayCollection();
    }

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

    public function getAvatarPath() {
        return $this->avatarPath;
    }

    public function setAvatarPath($avatarPath): self {
        $this->avatarPath = $avatarPath;

        return $this;
    }

    public function getSituationProfessionnelle(): string {
        return $this->situationProfessionnelle;
    }

    public function setSituationProfessionnelle(string $situationProfessionnelle): self {
        $this->situationProfessionnelle = $situationProfessionnelle;

        return $this;
    }

    public function getDisponibilite(): string {
        return $this->disponibilite;
    }

    public function setDisponibilite(string $disponibilite): self {
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

    /**
     * @return Collection|Experience[]
     */
    public function getExperiences(): Collection {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): self {
        if (!$this->experiences->contains($experience)) {
            $this->experiences[] = $experience;
            $experience->setCv($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self {
        if ($this->experiences->contains($experience)) {
            $this->experiences->removeElement($experience);
            // set the owning side to null (unless already changed)
            if ($experience->getCv() === $this) {
                $experience->setCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CompetenceDomaine[]
     */
    public function getDomainesCompetence(): Collection {
        return $this->domainesCompetence;
    }

    public function addDomaineCompetence(CompetenceDomaine $domaineCompetence): self {
        if (!$this->domainesCompetence->contains($domaineCompetence)) {
            $this->domainesCompetence[] = $domaineCompetence;
            $domaineCompetence->setCv($this);
        }

        return $this;
    }

    public function removeDomaineCompetence(CompetenceDomaine $domaineCompetence): self {
        if ($this->domainesCompetence->contains($domaineCompetence)) {
            $this->domainesCompetence->removeElement($domaineCompetence);
            // set the owning side to null (unless already changed)
            if ($domaineCompetence->getCv() === $this) {
                $domaineCompetence->setCv(null);
            }
        }

        return $this;
    }

}