<?php

namespace App\ImageFilter;

use App\Service\ImageFilter;
use Intervention\Image\Image;

class CvAvatarImageFilter extends ImageFilter
{

    /**
     * execute filter to given image
     *
     * @param  \Intervention\Image\Image $image
     * @return \Intervention\Image\Image
     */
    protected function execute(Image $image)
    {
        $image
            ->fit(200, 250);

        return $image;
    }

    public function getName()
    {
        return "cv_avatar";
    }

}