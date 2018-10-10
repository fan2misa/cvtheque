<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Yaml\Yaml;

/**
 * Description of AbstractFixture
 *
 * @author gjean
 */
abstract class AbstractFixture extends Fixture {
    
    protected function getData() {
        return Yaml::parse(file_get_contents(__DIR__ . '/' . trim($this->getYamlPath())));
    }
    
    protected function getReferencePath($fixture, $id) {
        return $fixture . $id;
    }
    
    protected abstract function getYamlPath();
}
