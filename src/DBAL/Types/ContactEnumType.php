<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * Description of TypeContratEnumType
 *
 * @author gjean
 */
class ContactEnumType extends AbstractEnumType {

    const EMAIL = "EMAIL";
    const TEL_MOBILE = "TEL_MOBILE";
    const TEL_FIXE = "TEL_FIXE";
    const SKYPE = "SKYPE";

    protected static $choices = [
        self::EMAIL => "Adresse email",
        self::TEL_MOBILE => "Téléphone mobile",
        self::TEL_FIXE => "Téléphone fixe",
        self::SKYPE => "Skype"
    ];
    
    protected static $iconsPath = [
        self::EMAIL => "fa fa-envelope",
        self::TEL_MOBILE => "fa fa-mobile",
        self::TEL_FIXE => "fa fa-phone",
        self::SKYPE => "fa fa-skype"
    ];
    
    public static function getIconClass($const) {
        return self::$iconsPath[$const];
    }
}
