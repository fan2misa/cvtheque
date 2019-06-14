<?php

namespace App\Service\Media\Provider;

use App\Entity\Media;
use App\Service\Media\BaseProvider;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileProvider extends BaseProvider
{
    public function saveFile(Media $media)
    {
        if ($media->getBinaryContent() instanceof UploadedFile) {
           $this->uploadFile($media);
        } else if ($media->getBinaryContent() instanceof File) {
            $this->copyFile($media);
        }
    }

    protected function copyFile(Media $media)
    {
        $file = $media->getBinaryContent();

        $this->createDirectoryIfNotExist();
        $filename = $this->getUniqueFilename($file);
        $this->filesystem->copy($file->getPathname(), $this->getDestinationPath($filename));

        $this->saveFileInfo($media, $media->getBinaryContent(), $filename);
    }

    protected function uploadFile(Media $media)
    {
        /** @var UploadedFile $file */
        $file = $media->getBinaryContent();

        $this->createDirectoryIfNotExist();
        $filename = $this->getUniqueFilename($file);
        $file->move($this->getDestinationDirectory(), $filename);

        $this->saveUploadedFileInfo($media, $media->getBinaryContent(), $filename);
    }

    protected function saveFileInfo(Media $media, File $file, string $filename)
    {
        $media
            ->setPath($this->getWebPath($filename))
            ->setName($file->getBasename('.' . $file->getExtension()))
            ->setSize($file->getSize())
            ->setMimeType($file->getMimeType());
    }

    protected function saveUploadedFileInfo(Media $media, UploadedFile $file, string $filename)
    {
        $media->setPath($this->getWebPath($filename))
            ->setName(basename($file->getClientOriginalName(), '.' . $file->getClientOriginalExtension()))
            ->setSize($file->getSize())
            ->setMimeType($file->getClientMimeType());
    }
}