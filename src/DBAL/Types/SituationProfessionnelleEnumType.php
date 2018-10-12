<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * Description of TypeContratEnumType
 *
 * @author gjean
 */
class SituationProfessionnelleEnumType extends AbstractEnumType {

    const EN_POSTE = "EN_POSTE";
    const EN_FIN_DE_CONTRAT = "EN_FIN_DE_CONTRAT";
    const EN_RECHERCHE_EMPLOI = "EN_RECHERCHE_EMPLOI";
    const FREELANCE = "FREELANCE";
    const CONSULTANT = "CONSULTANT";
    const ENTREPRENEUR = "ENTREPRENEUR";
    const PORTEUR_DE_PROJET = "PORTEUR_DE_PROJET";
    const ETUDIANT = "ETUDIANT";
    const EN_FIN_ETUDE = "EN_FIN_ETUDE";
    const STAGIAIRE = "STAGIAIRE";
    const APPRENTI = "APPRENTI";
    const EN_ALTERNANCE = "EN_ALTERNANCE";

    protected static $choices = [
        self::EN_POSTE => "En poste",
        self::EN_FIN_DE_CONTRAT => "En fin de contrat",
        self::EN_RECHERCHE_EMPLOI => "En recherche d'emploi",
        self::FREELANCE => "Freelance",
        self::CONSULTANT => "Consultant",
        self::ENTREPRENEUR => "Entrepreneur",
        self::PORTEUR_DE_PROJET => "Porteur de projet",
        self::ETUDIANT => "Étudiant",
        self::EN_FIN_ETUDE => "En fin d'études",
        self::STAGIAIRE => "Stagiaire",
        self::APPRENTI => "Apprenti",
        self::EN_ALTERNANCE => "En alternance",
    ];

}
