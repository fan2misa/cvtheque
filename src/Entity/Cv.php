<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CVRepository")
 * @ORM\EntityListeners({"App\EventListener\CvListener"})
 */
class Cv
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contact", mappedBy="cV", orphanRemoval=true, cascade={"persist"})
     */
    private $contacts;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Theme")
     */
    private $theme;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Formation", mappedBy="cv", orphanRemoval=true, cascade={"persist"})
     */
    private $formations;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $slug;

    public function __construct()
    {
        $this->experiences = new ArrayCollection();
        $this->domainesCompetence = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->formations = new ArrayCollection();
        $this->active = false;
    }

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

    public function getAvatarPath()
    {
        return $this->avatarPath;
    }

    public function setAvatarPath($avatarPath): self
    {
        $this->avatarPath = $avatarPath;

        return $this;
    }

    public function getSituationProfessionnelle()
    {
        return $this->situationProfessionnelle;
    }

    public function setSituationProfessionnelle($situationProfessionnelle): self
    {
        $this->situationProfessionnelle = $situationProfessionnelle;

        return $this;
    }

    public function getDisponibilite()
    {
        return $this->disponibilite;
    }

    public function setDisponibilite($disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Experience[]
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences[] = $experience;
            $experience->setCv($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
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
    public function getDomainesCompetence(): Collection
    {
        return $this->domainesCompetence;
    }

    public function addDomainesCompetence(CompetenceDomaine $domaineCompetence): self
    {
        if (!$this->domainesCompetence->contains($domaineCompetence)) {
            $this->domainesCompetence[] = $domaineCompetence;
            $domaineCompetence->setCV($this);
        }

        return $this;
    }

    public function removeDomainesCompetence(CompetenceDomaine $domaineCompetence): self
    {
        if ($this->domainesCompetence->contains($domaineCompetence)) {
            $this->domainesCompetence->removeElement($domaineCompetence);
            // set the owning side to null (unless already changed)
            if ($domaineCompetence->getCV() === $this) {
                $domaineCompetence->setCV(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setCV($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getCV() === $this) {
                $contact->setCV(null);
            }
        }

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
            $formation->setCv($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->contains($formation)) {
            $this->formations->removeElement($formation);
            // set the owning side to null (unless already changed)
            if ($formation->getCv() === $this) {
                $formation->setCv(null);
            }
        }

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

}
