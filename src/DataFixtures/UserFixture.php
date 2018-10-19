<?php

namespace App\DataFixtures;

use App\DataFixtures\AbstractFixture;
use App\DBAL\Types\ContactEnumType;
use App\Entity\Contact;
use App\Entity\User;
use App\Service\UserService;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends AbstractFixture {

    private $userService;

    const PREFIX_REFERENCE = 'user';
    
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function load(ObjectManager $manager) {
        foreach ($this->getData() as $data) {
            $entity = new User();
            
            $entity
                    ->setNom($data['nom'])
                    ->setPrenom($data['prenom'])
                    ->setEmail($data['email'])
                    ->setPassword($data['password'])
                    ->setEnabled(!!$data['enabled'])
                    ->setRoles($data['roles']);
            
            if (isset($data['contacts'])) {
                foreach ($data['contacts'] as $contactData) {
                    $contact = $this->getContact($contactData);
                    $entity->addContact($contact);
                }
            }
            
            $this->userService->registration($entity);
            
            $this->addReference($this->getReferencePath(self::PREFIX_REFERENCE, $data['id']), $entity);
        }
    }
    
    private function getContact(array $data): Contact {
        $contact = new Contact();
        
        $contact
                ->setType(constant(ContactEnumType::class . '::' . $data['type']))
                ->setValeur($data['valeur']);
        
        return $contact;
    }

    protected function getYamlPath() {
        return "data/user.yml";
    }

}
