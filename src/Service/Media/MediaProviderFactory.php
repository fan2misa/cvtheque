<?php

namespace App\Service\Media;

use App\Entity\Media;
use Exception;

class MediaProviderFactory
{
    private $providers;

    public function __construct()
    {
        $this->providers = [];
    }

    public function getProviderByMedia(Media $media)
    {
        if (null === $media->getProviderName()) {
            throw new Exception('Media need provider');
        }

        return $this->getProvider($media->getProviderName());
    }

    public function getProvider($name)
    {
        if (!isset($this->providers[$name])) {
            throw new Exception("Provider $name does not exist");
        }

        return $this->providers[$name];
    }

    public function addProvider(string $name, BaseProvider $provider)
    {
        if (isset($this->providers[$name])) {
            throw new Exception("Provider $name already exist");
        }

        $this->providers[$name] = $provider;
    }
}