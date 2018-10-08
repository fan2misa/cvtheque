<?php

namespace App\Entity;

use App\Enum\RoleEnum;
use DateTime;
use DateTimeInterface;
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

    public function __construct() {
        $this->dateInscription = new DateTime();
        $this->roles = [RoleEnum::ROLE_USER];
        $this->enabled = FALSE;
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

}
