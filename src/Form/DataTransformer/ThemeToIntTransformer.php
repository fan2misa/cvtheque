<?php

namespace App\Form\DataTransformer;

use App\Entity\Theme;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Description of ThemeToIntTransformer
 *
 * @author gjean
 */
class ThemeToIntTransformer implements DataTransformerInterface {

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * 
     * @param type $value
     * @return Theme
     */
    public function reverseTransform($value) {
        $entity = $this->entityManager->getRepository(Theme::class)->find($value);

        if (null === $entity) {
            throw new TransformationFailedException(sprintf('No theme exist!'));
        }

        return $entity;
    }

    /**
     * 
     * @param Theme $entity
     * @return type
     */
    public function transform($theme) {
        return null !== $theme ? $theme->getId() : null;
    }

}
