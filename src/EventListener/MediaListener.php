<?php

namespace App\EventListener;

use App\Entity\Media;
use App\Service\Media\MediaProviderFactory;

class MediaListener
{
    private $mediaProviderFactory;

    public function __construct(MediaProviderFactory $mediaProviderFactory)
    {
        $this->mediaProviderFactory = $mediaProviderFactory;
    }

    public function prePersist(Media $media)
    {
         $this->uploadBinaryContent($media);
    }

    public function preUpdate(Media $media)
    {
        $this->uploadBinaryContent($media);
    }

    protected function uploadBinaryContent(Media $media)
    {
        $provider = $this->mediaProviderFactory->getProviderByMedia($media);
        $provider->saveFile($media);
    }
}