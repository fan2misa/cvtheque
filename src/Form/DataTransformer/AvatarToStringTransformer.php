<?php

namespace App\Form\DataTransformer;

use App\Entity\Ville;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Description of VilleToStringTransformer
 *
 * @author gjean
 */
class AvatarToStringTransformer implements DataTransformerInterface {

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
        if ($value instanceof UploadedFile) {
            dump($value); exit;
            $value->move($this->getParameter('brochures_directory'), $fileName);
        }
    }

    /**
     * 
     * @param type $entity
     * @return type
     */
    public function transform($value) {
        return $value;
    }

}
