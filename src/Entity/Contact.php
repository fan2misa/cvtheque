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
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CV", inversedBy="contacts")
     */
    private $cV;

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

    public function getValeur() {
        return $this->valeur;
    }

    public function setValeur(string $valeur): self {
        $this->valeur = $valeur;

        return $this;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser(User $user = null): self {
        $this->user = $user;

        return $this;
    }

    public function getCV()
    {
        return $this->cV;
    }

    public function setCV(CV $cV = null): self
    {
        $this->cV = $cV;

        return $this;
    }

}
