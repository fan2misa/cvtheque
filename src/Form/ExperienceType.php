<?php

namespace App\Form;

use App\DBAL\Types\TypeContratEnumType;
use App\Entity\Experience;
use App\Form\DataTransformer\EntrepriseToStringTransformer;
use App\Form\DataTransformer\VilleToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceType extends AbstractType {

    private $entrepriseToStringTransformer;
    
    private $villeToStringTransformer;

    public function __construct(VilleToStringTransformer $villeToStringTransformer, EntrepriseToStringTransformer $entrepriseToStringTransformer) {
        $this->entrepriseToStringTransformer = $entrepriseToStringTransformer;
        $this->villeToStringTransformer = $villeToStringTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('typeContrat', ChoiceType::class, [
                    'choices' => TypeContratEnumType::getChoices()
                ])
                ->add('informationsGenerales', ExperienceInformationsGeneralesType::class)
                ->add('entreprise', TextType::class)
                ->add('ville', TextType::class)
                ->add('missions', CollectionType::class, [
                    'entry_type' => TextType::class,
                    'by_reference' => false,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true
                ]);

        $builder->get('entreprise')->addModelTransformer($this->entrepriseToStringTransformer);
        $builder->get('ville')->addModelTransformer($this->villeToStringTransformer);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }

}
