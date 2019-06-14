<?php

namespace App\DataFixtures;

use App\Entity\Media;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of AbstractFixture
 *
 * @author gjean
 */
abstract class AbstractFixture extends Fixture implements ContainerAwareInterface, FixtureGroupInterface
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    protected function getData()
    {
        return Yaml::parse(file_get_contents($this->getAssetsPath() . '/data/' . trim($this->getYamlPath())));
    }

    protected function getDateTime($timestamp)
    {
        $date = new DateTime();

        if (preg_match('/^now:(.*)/', $timestamp, $match)) {
            $date->modify($match[1]);
        } else {
            $date->setTimestamp($timestamp);
        }

        return $date;
    }

    protected function getReferenceEntity($fixture, $id)
    {
        return $this->getReference($this->getReferencePath($fixture, $id));
    }

    protected function getReferencePath($fixture, $id)
    {
        return $fixture . $id;
    }

    protected function createFile($path): File
    {
        return new File($this->getAssetsPath() . '/media/' . ltrim($path, '/'));
    }

    protected function createMedia($path, $providerName = 'media.provider.image', $context = 'default'): Media
    {
        return (new Media())
            ->setBinaryContent($this->createFile($path))
            ->setContext($context)
            ->setProviderName($providerName);
    }

    /**
     * Sets the container.
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    protected function getEnvironment(): string
    {
        return $this->container->get('kernel')->getEnvironment();
    }

    protected function getAssetsPath()
    {
        return $this->container->getParameter('kernel.project_dir') . '/assets/fixtures';
    }

    protected abstract function getYamlPath();
}
