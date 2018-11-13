<?php

namespace App\Service;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

abstract class ImageFilter implements FilterInterface
{

    /**
     * Applies filter to given image
     *
     * @param  \Intervention\Image\Image $image
     * @return \Intervention\Image\Image
     */
    public function applyFilter(Image $image)
    {
        $image = $this
            ->execute($image);

        return $image;
    }

    public abstract function getName();

    /**
     * execute filter to given image
     *
     * @param  \Intervention\Image\Image $image
     * @return \Intervention\Image\Image
     */
    protected abstract function execute(Image $image);

}
