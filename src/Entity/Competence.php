<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetenceRepository")
 */
class Competence
{

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
     * @Symfony\Component\Validator\Constraints\Range(
     *      min=0,
     *      max=5,
     *      minMessage="La valeur doit être superieur à {{ limit }}",
     *       maxMessage="La valeur doit être inferieur à {{ limit }}"
     * )
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompetenceDomaine", inversedBy="competences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $domaine;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getDomaine(): ?CompetenceDomaine
    {
        return $this->domaine;
    }

    public function setDomaine(?CompetenceDomaine $domaine): self
    {
        $this->domaine = $domaine;

        return $this;
    }

}
