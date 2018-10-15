<?php

namespace App\Form;

use App\Entity\ExperienceInformationsGenerales;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceInformationsGeneralesType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('intitulePoste', TextType::class)
                ->add('dateDebut', DateType::class, [
                    'widget' => 'single_text'
                ])
                ->add('dateFin', DateType::class, [
                    'required' => false,
                    'widget' => 'single_text'
                ])
                ->add('enCours', CheckboxType::class, [
                    'required' => false,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => ExperienceInformationsGenerales::class,
        ]);
    }

}
