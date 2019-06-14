<?php

namespace App\Service\Media;

use App\Entity\Media;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class BaseProvider
{
    protected $doctrine;

    protected $rootDir;

    protected $directory;

    protected $filesystem;

    public function __construct(Registry $doctrine, $rootDir, array $parameters)
    {
        $this->doctrine = $doctrine;
        $this->rootDir = $rootDir;
        $this->directory = $parameters['directory'];
        $this->filesystem = new Filesystem();
    }

    public function find(string $context = 'default')
    {
        return $this->doctrine->getRepository(Media::class)->findAll();
    }

    protected function createDirectoryIfNotExist()
    {
        if (!$this->filesystem->exists($this->directory)) {
            $this->filesystem->mkdir($this->directory);
        }
    }

    protected function getWebPath(?string $filename = null)
    {
        $data = [
            rtrim($this->directory, DIRECTORY_SEPARATOR)
        ];

        if (null !== $filename) {
            $data[] = $filename;
        }

        return implode(DIRECTORY_SEPARATOR, $data);
    }

    protected function getDestinationPath(string $filename)
    {
        return implode(DIRECTORY_SEPARATOR, [$this->getDestinationDirectory(), $filename]);
    }

    protected function getDestinationDirectory()
    {
        $data = [
            rtrim($this->rootDir, DIRECTORY_SEPARATOR),
            trim($this->directory, DIRECTORY_SEPARATOR)
        ];

        return implode(DIRECTORY_SEPARATOR, $data);
    }

    protected function getUniqueFilename(File $file)
    {
        $filename = $file instanceof UploadedFile ? $file->getClientOriginalName(): $file->getFilename();
        $key = 1;

        while ($this->filesystem->exists($this->getDestinationPath($filename))) {
            $filename = $file instanceof UploadedFile
                ? basename($file->getClientOriginalName(), '.' . $file->getClientOriginalExtension()) . ' (' . $key . ')' . $file->getClientOriginalExtension()
                : $file->getBasename('.' . $file->getExtension()) . ' (' . $key++ . ').' . $file->getExtension();
        };
        return $filename;
    }

    public abstract function saveFile(Media $media);
}