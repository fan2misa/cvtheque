<?php

namespace App\Form\DataTransformer;

use App\Entity\Ville;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Description of VilleToStringTransformer
 *
 * @author gjean
 */
class VilleToStringTransformer implements DataTransformerInterface {

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * 
     * @param type $value
     * @return Ville
     */
    public function reverseTransform($value) {
        $entity = $this->entityManager->getRepository(Ville::class)->findOneBy(['nom' => $value]);
        
        if (null === $entity) {
            $entity = new Ville();
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
