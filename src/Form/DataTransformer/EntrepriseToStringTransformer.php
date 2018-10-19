<?php

namespace App\Form\DataTransformer;

use App\Entity\Entreprise;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Description of EntrepriseToStringTransformer
 *
 * @author gjean
 */
class EntrepriseToStringTransformer implements DataTransformerInterface {

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * 
     * @param type $value
     * @return Entreprise
     */
    public function reverseTransform($value) {
        $entity = $this->entityManager->getRepository(Entreprise::class)->findOneBy(['nom' => $value]);
        
        if (null === $entity) {
            $entity = new Entreprise();
            $entity->setNom($value);
        }
        
        return $entity;
    }

    /**
     * 
     * @param type $entity
     * @return type
     */
    public function transform($entity) {
        return $entity;
    }

}
