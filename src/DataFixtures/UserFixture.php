<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends AbstractFixture {

    const PREFIX_REFERENCE = 'user';
    
    public function getOrder(): integer {
        
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
            
            $manager->persist($entity);
            
            $this->addReference($this->getReferencePath(self::PREFIX_REFERENCE, $data['id']), $entity);
        }
        
        $manager->flush();
    }

    protected function getYamlPath() {
        return "data/user.yml";
    }

}
