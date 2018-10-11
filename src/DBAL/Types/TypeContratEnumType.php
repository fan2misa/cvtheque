<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * Description of TypeContratEnumType
 *
 * @author gjean
 */
class TypeContratEnumType extends AbstractEnumType {

    const CDI = "CDI";
    const CDD = "CDD";
    const STAGE = "STA";
    const INTERIM = "INT";
    const CONTRAT_APPRENTISSAGE = "CA";
    const CONTRAT_PROFESSIONNALISATION = "CP";
    const EMPLOIS_JEUNES = "EJ";
    const PROJET_ETUDIANT = "PE";
    const BENEVOLAT = "BEN";
    const FREELANCE = "FREE";
    const VACATAIRE = "VAC";
    const AUTRE = "AUT";

    protected static $choices = [
        self::CDI => "CDI",
        self::CDD => "CDD",
        self::STAGE => "Stage",
        self::INTERIM => "Intérim",
        self::CONTRAT_APPRENTISSAGE => "Contrat d'apprentissage",
        self::CONTRAT_PROFESSIONNALISATION => "Contrat de professionnalisation",
        self::EMPLOIS_JEUNES => "Emplois-jeunes",
        self::PROJET_ETUDIANT => "Projet étudiant",
        self::BENEVOLAT => "Bénévolat",
        self::FREELANCE => "Freelance",
        self::VACATAIRE => "Vacataire",
        self::AUTRE => "Autre",
    ];

    public static function getLabel($const) {
        return self::$choices[$const];
    }
}
