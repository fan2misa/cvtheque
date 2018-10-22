<?php

namespace App\Form;

use App\DBAL\Types\DisponibiliteEnumType;
use App\DBAL\Types\SituationProfessionnelleEnumType;
use App\Entity\Cv;
use App\Form\DataTransformer\AvatarToStringTransformer;
use App\Form\ContactType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CVType extends AbstractType {

    private $avatarToStringTransformer;

    public function __construct(AvatarToStringTransformer $avatarToStringTransformer) {
        $this->avatarToStringTransformer = $avatarToStringTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom', TextType::class)
                ->add('avatarPath', FileType::class, [
                    'required' => false,
                    'data' => null
                ])
                ->add('contacts', CollectionType::class, [
                    'entry_type' => ContactType::class,
                    'by_reference' => false,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                ])
                ->add('situationProfessionnelle', ChoiceType::class, [
                    'choices' => SituationProfessionnelleEnumType::getChoices()
                ])
                ->add('disponibilite', ChoiceType::class, [
                    'choices' => DisponibiliteEnumType::getChoices()
                ])
                ->add('experiences', CollectionType::class, [
                    'entry_type' => ExperienceType::class,
                    'by_reference' => false,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true
                ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Cv::class,
        ]);
    }

}
