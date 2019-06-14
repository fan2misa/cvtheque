<?php

namespace App\Service\Media\Provider;

use App\Entity\Media;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageProvider extends FileProvider
{
    protected function saveFileInfo(Media $media, File $file, string $filename)
    {
        parent::saveFileInfo($media, $file, $filename);
        $this->saveImageInfo($media, $file);
    }

    protected function saveUploadedFileInfo(Media $media, UploadedFile $file, string $filename)
    {
        parent::saveUploadedFileInfo($media, $file, $filename);
        $this->saveImageInfo($media, $file);
    }

    private function saveImageInfo(Media $media, File $file)
    {
        if (!!$data = $this->getImageInfo($file)) {
            $media
                ->setWidth($data[0])
                ->setHeight($data[1]);
        } else {
            $media
                ->setWidth(null)
                ->setHeight(null);
        }
    }

    private function getImageInfo(File $file)
    {
        return @getimagesize($file);
    }
}