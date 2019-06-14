<?php

namespace App\DataFixtures;

use App\DataFixtures\AbstractFixture;
use App\Entity\Ville;
use Doctrine\Common\Persistence\ObjectManager;

class VilleFixture extends AbstractFixture {

    const PREFIX_REFERENCE = 'ville';

    public function load(ObjectManager $manager) {
        foreach ($this->getData() as $data) {
            $entity = new Ville();
            
            $entity
                    ->setNom($data['nom'])
                    ->setCodePostal($data['code_postal'])
                    ->setPays($data['pays']);
            
            $manager->persist($entity);
            
            $this->addReference($this->getReferencePath(self::PREFIX_REFERENCE, $data['id']), $entity);
        }
        
        $manager->flush();
    }

    protected function getYamlPath() {
        return "ville.yml";
    }

    public static function getGroups(): array
    {
        return ['dev'];
    }
}
