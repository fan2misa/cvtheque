<?php

namespace App\ImageFilter;

use App\Service\ImageFilter;
use Intervention\Image\Image;

class UserAvatarImageFilter extends ImageFilter
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
            ->fit(100, 120);

        return $image;
    }

    public function getName()
    {
        return "user_avatar";
    }

}