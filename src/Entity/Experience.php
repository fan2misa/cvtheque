<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExperienceRepository")
 */
class Experience
{

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="experiences", cascade={"persist"})
     */
    private $entreprise;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cv", inversedBy="experiences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cv;

    /**
     * @ORM\Column(type="TypeContratEnumType")
     * @Fresh\DoctrineEnumBundle\Validator\Constraints\Enum(entity="App\DBAL\Types\TypeContratEnumType")
     */
    private $typeContrat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", cascade={"persist"})
     */
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mission", mappedBy="experience", orphanRemoval=true, cascade={"persist"})
     */
    private $missions;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     *
     * @return \App\Entity\ExperienceInformationsGenerales
     */
    public function getInformationsGenerales(): ExperienceInformationsGenerales
    {
        return $this->informationsGenerales;
    }

    /**
     *
     * @param \App\Entity\ExperienceInformationsGenerales $informationsGenerales
     * @return \self
     */
    public function setInformationsGenerales(ExperienceInformationsGenerales $informationsGenerales): self
    {
        $this->informationsGenerales = $informationsGenerales;

        return $this;
    }

    /**
     *
     * @return \App\Entity\Entreprise
     */
    public function getEntreprise(): Entreprise
    {
        return $this->entreprise;
    }

    /**
     *
     * @param \App\Entity\Entreprise $entreprise
     * @return \self
     */
    public function setEntreprise(Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     *
     * @return \App\Entity\Cv
     */
    public function getCv(): Cv
    {
        return $this->cv;
    }

    /**
     *
     * @param \App\Entity\Cv $cv
     * @return \self
     */
    public function setCv(?Cv $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getTypeContrat(): string
    {
        return $this->typeContrat;
    }

    /**
     *
     * @param string $typeContrat
     * @return \self
     */
    public function setTypeContrat(string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }

    /**
     *
     * @return \App\Entity\Ville
     */
    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    /**
     *
     * @param \App\Entity\Ville $ville
     * @return \self
     */
    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection|Mission[]
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
            $mission->setExperience($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->contains($mission)) {
            $this->missions->removeElement($mission);
            // set the owning side to null (unless already changed)
            if ($mission->getExperience() === $this) {
                $mission->setExperience(null);
            }
        }

        return $this;
    }

}
