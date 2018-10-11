<?php

namespace App\DataFixtures;

use App\DataFixtures\AbstractFixture;
use App\DBAL\Types\TypeContratEnumType;
use App\Entity\CV;
use App\Entity\Experience;
use App\Entity\ExperienceInformationsGenerales;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CvFixture extends AbstractFixture implements DependentFixtureInterface {

    const PREFIX_REFERENCE = 'cv';

    public function load(ObjectManager $manager) {
        foreach ($this->getData() as $data) {
            $entity = new CV();

            $entity
                    ->setNom($data['nom'])
                    ->setUser($this->getReference($this->getReferencePath(UserFixture::PREFIX_REFERENCE, $data['user_id'])));

            if (isset($data['experiences'])) {
                foreach ($data['experiences'] as $experienceData) {
                    $experience = new Experience();

                    $informationsGenerales = new ExperienceInformationsGenerales();

                    $informationsGenerales
                            ->setIntitulePoste($experienceData['informations_generales']['intitule_poste'])
                            ->setDateDebut($this->getDateTime($experienceData['informations_generales']['date_debut']));

                    if (isset($experienceData['informations_generales']['date_fin'])) {
                        $informationsGenerales->setEnCours(FALSE);
                        $informationsGenerales->setDateFin($this->getDateTime($experienceData['informations_generales']['date_fin']));
                    } else {
                        $informationsGenerales->setEnCours(TRUE);
                    }
                    
                    $experience
                            ->setInformationsGenerales($informationsGenerales)
                            ->setTypeContrat(constant(TypeContratEnumType::class . '::' . $experienceData['type_contrat']))
                            ->setEntreprise($this->getReference($this->getReferencePath(EntrepriseFixture::PREFIX_REFERENCE, $experienceData['entreprise_id'])));
                    
                    $entity->addExperience($experience);
                }
            }
            
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
            EntrepriseFixture::class,
        ];
    }

}
