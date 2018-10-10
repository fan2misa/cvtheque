<?php

namespace App\DataFixtures;

use App\Entity\CV;
use App\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CvFixture extends AbstractFixture implements DependentFixtureInterface {

    const PREFIX_REFERENCE = 'cv';

    public function getOrder(): integer {
        
    }

    public function load(ObjectManager $manager) {
        foreach ($this->getData() as $data) {
            $entity = new CV();

            $entity
                    ->setNom($data['nom'])
                    ->setUser($this->getReference($this->getReferencePath(UserFixture::PREFIX_REFERENCE, $data['user_id'])));

            $manager->persist($entity);

            $this->addReference($this->getReferencePath(self::PREFIX_REFERENCE, $data['id']), $entity);
        }

        $manager->flush();
    }

    protected function getYamlPath() {
        return "data/cv.yml";
    }

    public function getDependencies(): array {
        return [
            UserFixture::class,
        ];
    }

}
