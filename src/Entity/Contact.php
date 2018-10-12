<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="ContactEnumType")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $valeur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="contacts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): int {
        return $this->id;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type): self {
        $this->type = $type;

        return $this;
    }

    public function getValeur(): string {
        return $this->valeur;
    }

    public function setValeur(string $valeur): self {
        $this->valeur = $valeur;

        return $this;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function setUser(User $user): self {
        $this->user = $user;

        return $this;
    }

}
