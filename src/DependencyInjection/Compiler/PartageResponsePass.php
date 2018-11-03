<?php

namespace App\DependencyInjection\Compiler;

use App\Service\PartageResponseService;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class PartageResponsePass implements CompilerPassInterface {

    /**
     * You can modify the container here before it is dumped to PHP code.
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(PartageResponseService::class)) {
            return;
        }

        $definition = $container->findDefinition(PartageResponseService::class);

        $taggedServices = $container->findTaggedServiceIds('app.partage_response');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addPartageResponse', [new Reference($id), $tags[0]['extension']]);
        }
    }
}