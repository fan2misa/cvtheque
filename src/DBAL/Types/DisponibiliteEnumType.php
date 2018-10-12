<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * Description of TypeContratEnumType
 *
 * @author gjean
 */
class DisponibiliteEnumType extends AbstractEnumType {

    const RECHERCHE_ACTIVE = "RECHERCHE_ACTIVE";
    const RECHERCHE_STAGE = "RECHERCHE_STAGE";
    const SIMPLE_VEILLE = "SIMPLE_VEILLE";
    const OPPORTUNITE = "OPPORTUNITE";
    const INDISPONIBLE = "INDISPONIBLE";

    protected static $choices = [
        self::RECHERCHE_ACTIVE => "En recherche active",
        self::RECHERCHE_STAGE => "En recherche de stage",
        self::SIMPLE_VEILLE => "En simple veille",
        self::OPPORTUNITE => "Ouvert aux opportunités",
        self::INDISPONIBLE => "Indisponible"
    ];

}
