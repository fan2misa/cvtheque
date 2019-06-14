<?php

namespace App\Service;

use App\Filters\FilterInterface;
use Intervention\Image\ImageManager as InterventionImageManager;
use Symfony\Component\Filesystem\Filesystem;

class ImageManager extends InterventionImageManager
{
    /**
     * @var FilterInterface
     */
    private $imageFilters;

    private $projectDir;

    private $fileSystem;

    public function __construct(string $projectDir)
    {
        parent::__construct();
        $this->projectDir = rtrim($projectDir, DIRECTORY_SEPARATOR) . '/public';
        $this->fileSystem = new Filesystem();
    }

    public function addImageFilter(FilterInterface $imageFilter, $id)
    {
        $this->imageFilters[$id] = $imageFilter;
    }

    public function getFilter($id): FilterInterface
    {
        return $this->imageFilters[$id];
    }

    public function get($path, $filterId)
    {
        $filter = $this->getFilter($filterId);

        if (!$this->filteredImageExist($path, $filter)) {
            $this->make($this->projectDir . $path)->filter($filter)->save($this->getFilteredImagePath($this->projectDir . $path, $filter))->destroy();
        }

        return $this->getFilteredImagePath($path, $filter);
    }

    protected function filteredImageExist($path, FilterInterface $filter)
    {
        return $this->fileSystem->exists($this->getFilteredImagePath($path, $filter));
    }

    protected function getFilteredImagePath($path, FilterInterface $filter)
    {
        $directory = pathinfo($path, PATHINFO_DIRNAME) . '/' . trim($filter->getFoldername(), '/');

        if (!$this->fileSystem->exists($this->projectDir . '/' . ltrim($directory))) {
            $this->fileSystem->mkdir($this->projectDir . '/' . ltrim($directory));
        }

        return $directory . '/' . pathinfo($path, PATHINFO_FILENAME) . '.' . pathinfo($path, PATHINFO_EXTENSION);
    }
}