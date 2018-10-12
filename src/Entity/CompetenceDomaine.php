<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetenceDomaineRepository")
 */
class CompetenceDomaine {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Competence", mappedBy="domaine", orphanRemoval=true, cascade={"persist"})
     */
    private $competences;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CV", inversedBy="domaines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cv;

    public function __construct() {
        $this->competences = new ArrayCollection();
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

    /**
     * @return Collection|Competence[]
     */
    public function getCompetences(): Collection {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): self {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            $competence->setDomaine($this);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self {
        if ($this->competences->contains($competence)) {
            $this->competences->removeElement($competence);
            // set the owning side to null (unless already changed)
            if ($competence->getDomaine() === $this) {
                $competence->setDomaine(null);
            }
        }

        return $this;
    }

    public function getCv(): CV {
        return $this->cv;
    }

    public function setCv(CV $cv): self {
        $this->cv = $cv;

        return $this;
    }

}
