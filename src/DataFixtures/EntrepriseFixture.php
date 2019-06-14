<?php

namespace App\DataFixtures;

use App\DataFixtures\AbstractFixture;
use App\Entity\Entreprise;
use Doctrine\Common\Persistence\ObjectManager;

class EntrepriseFixture extends AbstractFixture {

    const PREFIX_REFERENCE = 'entreprise';

    public function load(ObjectManager $manager) {
        foreach ($this->getData() as $data) {
            $entity = new Entreprise();

            $entity
                    ->setNom($data['nom'])
                    ->setDescription($data['description']);

            $manager->persist($entity);

            $this->addReference($this->getReferencePath(self::PREFIX_REFERENCE, $data['id']), $entity);
        }

        $manager->flush();
    }

    protected function getYamlPath() {
        return "entreprise.yml";
    }

    public static function getGroups(): array
    {
        return ['dev'];
    }
}
