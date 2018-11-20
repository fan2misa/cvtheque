<?php

namespace App\Service\Wrapper;

use App\Entity\Theme;

class ThemeWrapperService {

    public function generateWrapper(Theme $theme, $extension)
    {
        $themeWrapper = new \App\Service\Wrapper\Entity\Theme();

        $themeWrapper
            ->setPublicPath($theme->getPublicPath())
            ->setTemplatePath($theme->getTemplatePath())
        ;

        return $themeWrapper;
    }

}
