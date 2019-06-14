<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

final class MediaAdmin extends AbstractAdmin
{

    public function getFilterParameters()
    {
        $default = [
            'context' => ['value' => 'default'],
        ];

        $this->datagridValues = array_merge($default, $this->datagridValues);

        return parent::getFilterParameters();
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->add('browser', 'browser');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('providerName')
            ->add('context', null, array(), ChoiceType::class, [
                'choices' => [
                    'default' => 'default',
                    'teams' => 'teams',
                ]
            ])
            ->add('name')
            ->add('size')
            ->add('mimeType')
            ->add('width')
            ->add('height')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('path')
            ->add('providerName')
            ->add('name')
            ->add('size')
            ->add('mimeType')
            ->add('width')
            ->add('height')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('path')
            ->add('providerName')
            ->add('name')
            ->add('size')
            ->add('mimeType')
            ->add('width')
            ->add('height')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('path')
            ->add('providerName')
            ->add('name')
            ->add('size')
            ->add('mimeType')
            ->add('width')
            ->add('height')
            ;
    }
}
