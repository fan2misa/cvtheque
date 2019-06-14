<?php

namespace App\Form;

use App\Entity\Media;
use App\Form\DataTransformer\MediaTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('path', HiddenType::class, [
                'required' => false
            ])
            ->add('binaryContent', FileType::class, [
                'required' => false
            ])
            ->add('providerName', HiddenType::class, [
                'data' => $options['provider']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);

        $resolver->setRequired('provider');
        $resolver->setAllowedTypes('provider', 'string');
    }
}
