<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetenceRepository")
 */
class Competence {

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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompetenceDomaine", inversedBy="competences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $domaine;

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

    public function getNote() {
        return $this->note;
    }

    public function setNote($note): self {
        $this->note = $note;

        return $this;
    }

    public function getDomaine() {
        return $this->domaine;
    }

    public function setDomaine(CompetenceDomaine $domaine): self {
        $this->domaine = $domaine;

        return $this;
    }

}
