<?php

namespace App\Service;

use App\DBAL\Types\ContactEnumType;
use App\Entity\Contact;

/**
 * Description of CVService
 *
 * @author gjean
 */
class ContactService {
    
    public function __construct() {
        
    }
    
    public function getIconClass(Contact $contact): string {
        return ContactEnumType::getIconClass(constant(ContactEnumType::class . '::' . $contact->getType()));
    }
}
