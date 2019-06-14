<?php

namespace App\DataFixtures;

use App\DataFixtures\AbstractFixture;
use App\DBAL\Types\ContactEnumType;
use App\DBAL\Types\DisponibiliteEnumType;
use App\DBAL\Types\SituationProfessionnelleEnumType;
use App\DBAL\Types\TypeContratEnumType;
use App\Entity\Competence;
use App\Entity\CompetenceDomaine;
use App\Entity\Cv;
use App\Entity\Contact;
use App\Entity\Experience;
use App\Entity\ExperienceInformationsGenerales;
use App\Entity\Formation;
use App\Entity\Mission;
use App\Entity\Theme;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CvFixture extends AbstractFixture implements DependentFixtureInterface {

    const PREFIX_REFERENCE = 'cv';

    public function load(ObjectManager $manager) {
        foreach ($this->getData() as $data) {
            $entity = new Cv();

            $entity
                    ->setNom($data['nom'])
                    ->setUser($this->getReference($this->getReferencePath(UserFixture::PREFIX_REFERENCE, $data['user_id'])))
                    ->setTheme($this->getTheme($manager, $data['theme']));

            if (isset($data['disponibilite'])) {
                $entity->setDisponibilite(constant(DisponibiliteEnumType::class . '::' . $data['disponibilite']));
            }

            if (isset($data['situation_professionnelle'])) {
                $entity->setSituationProfessionnelle(constant(SituationProfessionnelleEnumType::class . '::' . $data['situation_professionnelle']));
            }

            if (isset($data['contacts'])) {
                foreach ($data['contacts'] as $contactData) {
                    $contact = $this->getContact($contactData);
                    $entity->addContact($contact);
                }
            }

            if (isset($data['formations'])) {
                foreach ($data['formations'] as $formationData) {
                    $formation = $this->getFormation($formationData);
                    $entity->addFormation($formation);
                }
            }

            if (isset($data['experiences'])) {
                foreach ($data['experiences'] as $experienceData) {
                    $experience = $this->getExperience($experienceData);
                    $entity->addExperience($experience);
                }
            }

            if (isset($data['domaines_competence'])) {
                foreach ($data['domaines_competence'] as $domainesCompetenceData) {
                    $domainesCompetence = $this->getDomaineCompetence($domainesCompetenceData);
                    $entity->addDomainesCompetence($domainesCompetence);
                }
            }

            $manager->persist($entity);

            $this->addReference($this->getReferencePath(self::PREFIX_REFERENCE, $data['id']), $entity);
        }

        $manager->flush();
    }

    private function getTheme(ObjectManager $manager, string $slug): Theme {
        return $manager->getRepository(Theme::class)->findOneBy(['slug' => $slug]);
    }

    private function getContact(array $data): Contact {
        $contact = new Contact();

        $contact
                ->setType(constant(ContactEnumType::class . '::' . $data['type']))
                ->setValeur($data['valeur']);

        return $contact;
    }

    private function getFormation(array $data): Formation {
        $formation = new Formation();

        $formation
            ->setFormation($data['formation'])
            ->setEtablissement($data['etablissement'])
            ->setDateDebut($this->getDateTime($data['date_debut']));

        if (isset($data['date_fin'])) {
            $formation->setDateFin($this->getDateTime($data['date_fin']));
        }

        if (isset($data['description'])) {
            $formation->setDescription($data['description']);
        }

        return $formation;
    }

    private function getExperience(array $data): Experience {
        $experience = new Experience();

        $informationsGenerales = $this->getExperienceInformationsGenerales($data['informations_generales']);

        $experience
                ->setInformationsGenerales($informationsGenerales)
                ->setTypeContrat(constant(TypeContratEnumType::class . '::' . $data['type_contrat']))
                ->setEntreprise($this->getReference($this->getReferencePath(EntrepriseFixture::PREFIX_REFERENCE, $data['entreprise_id'])))
                ->setVille($this->getReference($this->getReferencePath(VilleFixture::PREFIX_REFERENCE, $data['ville_id'])));

        if (isset($data['missions'])) {
            foreach ($data['missions'] as $missionData) {
                $mission = $this->getMission($missionData);
                $experience->addMission($mission);
            }
        }

        return $experience;
    }

    private function getMission(array $data): Mission {
        $mission = new Mission();
        $mission
            ->setContenu($data['contenu']);

        return $mission;
    }

    private function getExperienceInformationsGenerales(array $data): ExperienceInformationsGenerales {
        $informationsGenerales = new ExperienceInformationsGenerales();

        $informationsGenerales
                ->setIntitulePoste($data['intitule_poste'])
                ->setDateDebut($this->getDateTime($data['date_debut']));

        if (isset($data['date_fin']) && null !== $data['date_fin']) {
            $informationsGenerales->setEnCours(FALSE);
            $informationsGenerales->setDateFin($this->getDateTime($data['date_fin']));
        } else {
            $informationsGenerales->setEnCours(TRUE);
        }

        return $informationsGenerales;
    }

    private function getDomaineCompetence(array $data): CompetenceDomaine {
        $domaine = new CompetenceDomaine();

        $domaine
                ->setNom($data['nom']);

        if (isset($data['competences'])) {
            foreach ($data['competences'] as $competenceData) {
                $competence = $this->getCompetence($competenceData);
                $domaine->addCompetence($competence);
            }
        }

        return $domaine;
    }

    private function getCompetence(array $data): Competence {
        $competence = new Competence();

        $competence
                ->setNom($data['nom'])
                ->setNote($data['note']);

        return $competence;
    }

    protected function getYamlPath() {
        return "cv.yml";
    }

    public function getDependencies(): array {
        return [
            UserFixture::class,
            EntrepriseFixture::class,
            VilleFixture::class,
        ];
    }

    public static function getGroups(): array
    {
        return ['dev'];
    }
}
