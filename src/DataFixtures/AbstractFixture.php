<?php

namespace App\DataFixtures;

use DateTime;
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
    
    protected function getDateTime($timestamp) {
        $date = new DateTime();
        $date->setTimestamp($timestamp);
        return $date;
    }
    
    protected function getReferencePath($fixture, $id) {
        return $fixture . $id;
    }
    
    protected abstract function getYamlPath();
}
