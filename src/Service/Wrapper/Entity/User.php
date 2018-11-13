<?php

namespace App\Service\Wrapper\Entity;

class User {

    private $nom;

    private $prenom;

    private $email;

    private $dateAnniversaire;

    /**
     * @return null|string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param null|string $nom
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param null|string $prenom
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFullname(): ?string
    {
        return $this->prenom . ' ' . $this->nom;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateAnniversaire()
    {
        return $this->dateAnniversaire;
    }

    /**
     * @param \DateTime $dateAnniversaire
     * @return User
     */
    public function setDateAnniversaire($dateAnniversaire)
    {
        $this->dateAnniversaire = $dateAnniversaire;
        return $this;
    }

}
