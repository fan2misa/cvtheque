<?php

namespace App\Service\Wrapper\Entity;

class Cv {

    private $nom;

    private $avatar;

    private $situationProfessionnelle;

    private $disponibilite;

    private $user;

    private $experiences;

    private $domainesCompetence;

    private $contacts;

    private $theme;

    private $formations;

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     * @return Cv
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     * @return Cv
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSituationProfessionnelle()
    {
        return $this->situationProfessionnelle;
    }

    /**
     * @param mixed $situationProfessionnelle
     * @return Cv
     */
    public function setSituationProfessionnelle($situationProfessionnelle)
    {
        $this->situationProfessionnelle = $situationProfessionnelle;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDisponibilite()
    {
        return $this->disponibilite;
    }

    /**
     * @param mixed $disponibilite
     * @return Cv
     */
    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Cv
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExperiences()
    {
        return $this->experiences;
    }

    /**
     * @param mixed $experiences
     * @return Cv
     */
    public function setExperiences($experiences)
    {
        $this->experiences = $experiences;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDomainesCompetence()
    {
        return $this->domainesCompetence;
    }

    /**
     * @param mixed $domainesCompetence
     * @return Cv
     */
    public function setDomainesCompetence($domainesCompetence)
    {
        $this->domainesCompetence = $domainesCompetence;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * @param mixed $contacts
     * @return Cv
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;
        return $this;
    }

    /**
     * @return Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param Theme $theme
     * @return Cv
     */
    public function setTheme(Theme $theme)
    {
        $this->theme = $theme;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFormations()
    {
        return $this->formations;
    }

    /**
     * @param mixed $formations
     * @return Cv
     */
    public function setFormations($formations)
    {
        $this->formations = $formations;
        return $this;
    }

}
