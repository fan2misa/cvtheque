<?php

namespace App\Service;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\ImageManager as InterventionImageManager;
use Symfony\Component\Filesystem\Filesystem;

class ImageManager extends InterventionImageManager
{
    /**
     * @var ImageFilter
     */
    private $imageFilters;

    private $fileSystem;

    public function __construct(array $parameter)
    {
        parent::__construct($parameter);
        $this->imageFilters = [];
        $this->fileSystem = new Filesystem();
    }

    public function addImageFilter(FilterInterface $imageFilter, $id)
    {
        $this->imageFilters[$id] = $imageFilter;
    }

    public function get($path, $filterId)
    {
        $filter = $this->getFilter($filterId);

        if (!$this->imageExist($filter, $path)) {
            $this->fileSystem->mkdir($this->getImageDir($filter, $path));

            $image = $this->make($path);
            $image
                ->filter($filter)
                ->save($this->getImagePath($filter, $path));
        }

        return $this->getImagePath($filter, $path);
    }

    public function imageExist(ImageFilter $filter, $path)
    {
        return file_exists($this->getImagePath($filter, $path));
    }

    public function getImageDir(ImageFilter $filter, $path)
    {
        return implode('/', [dirname($path), $filter->getName()]);
    }

    public function getImagePath(ImageFilter $filter, $path)
    {
        return implode('/', [$this->getImageDir($filter, $path), basename($path)]);
    }

    private function getFilter($filter): ImageFilter
    {
        return $this->imageFilters[$filter];
    }
}
