<?php

namespace App\Entity;

use App\Enum\RoleEnum;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Cette adresse email existe déjà")
 */
class User implements UserInterface {

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
     * @ORM\Column(type="string", length=100)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateInscription;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tokenInscription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatarPath;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CV", mappedBy="user", orphanRemoval=true)
     */
    private $cvs;

    public function __construct() {
        $this->dateInscription = new DateTime();
        $this->roles = [RoleEnum::ROLE_USER];
        $this->enabled = FALSE;
        $this->cvs = new ArrayCollection();
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

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self {
        $this->prenom = $prenom;

        return $this;
    }
    
    public function getFullname() {
        return $this->prenom . ' ' . $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = $email;

        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword(string $password): self {
        $this->password = $password;

        return $this;
    }

    public function getDateInscription(): DateTimeInterface {
        return $this->dateInscription;
    }

    public function setDateInscription(DateTimeInterface $dateInscription): self {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getRoles(): array {
        return $this->roles;
    }

    public function setRoles(array $roles): self {
        $this->roles = $roles;

        return $this;
    }

    public function eraseCredentials() {
        
    }

    public function getSalt() {
        
    }

    public function getUsername() {
        return $this->email;
    }

    public function getEnabled() {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self {
        $this->enabled = $enabled;

        return $this;
    }

    public function getTokenInscription() {
        return $this->tokenInscription;
    }

    public function setTokenInscription($tokenInscription): self {
        $this->tokenInscription = $tokenInscription;

        return $this;
    }

    public function getAvatarPath() {
        return $this->avatarPath;
    }

    public function setAvatarPath($avatarPath): self {
        $this->avatarPath = $avatarPath;

        return $this;
    }

    /**
     * @return Collection|CV[]
     */
    public function getCvs(): Collection
    {
        return $this->cvs;
    }

    public function addCv(CV $cv): self
    {
        if (!$this->cvs->contains($cv)) {
            $this->cvs[] = $cv;
            $cv->setUser($this);
        }

        return $this;
    }

    public function removeCv(CV $cv): self
    {
        if ($this->cvs->contains($cv)) {
            $this->cvs->removeElement($cv);
            // set the owning side to null (unless already changed)
            if ($cv->getUser() === $this) {
                $cv->setUser(null);
            }
        }

        return $this;
    }

}
