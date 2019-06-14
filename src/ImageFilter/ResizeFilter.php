<?php

namespace App\ImageFilter;

use App\Filters\FilterInterface;
use Intervention\Image\Image;

class ResizeFilter implements FilterInterface
{
    private $name;
    private $width;
    private $height;

    public function __construct($name, $width, $height)
    {
        $this->name = $name;
        $this->width = $width;
        $this->height = $height;
    }

    public function getFoldername()
    {
        return $this->name;
    }

    public function applyFilter(Image $image)
    {
        $image
            ->fit($this->width, $this->height);

        return $image;
    }

}