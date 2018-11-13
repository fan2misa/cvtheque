<?php

namespace App\DependencyInjection\Compiler;

use App\Service\ImageManager;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ImageFilterPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container)
    {
        if (!$container->has(ImageManager::class)) {
            return;
        }

        $definition = $container->findDefinition(ImageManager::class);

        $taggedServices = $container->findTaggedServiceIds('app.intervention.image_filter');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addImageFilter', [new Reference($id), $id]);
        }
    }
}