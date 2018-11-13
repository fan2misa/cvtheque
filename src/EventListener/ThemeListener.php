<?php

namespace App\EventListener;

use App\Entity\Theme;
use App\Service\ImageManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Filesystem\Filesystem;

class ThemeListener
{

    private $packages;

    private $imageManager;

    private $publicPath;

    private $parameters;

    private $fileSystem;

    const IMAGINE_FILTER = 'theme_avatar';

    public function __construct(Packages $packages, ImageManager $imageManager, $public_path, $parameters) {
        $this->packages = $packages;
        $this->imageManager = $imageManager;
        $this->publicPath = $public_path;
        $this->parameters = $parameters;
        $this->fileSystem = new Filesystem();
    }

    public function postLoad(Theme $theme, LifecycleEventArgs $event)
    {
        $avatar = null !== $theme->getAvatar() && file_exists($this->publicPath . '/' . $theme->getAvatar())
            ? $theme->getAvatar()
            : $this->parameters['default'];

        if (!preg_match('/^(http|https)/', $avatar)) {
            $avatar = $this->imageManager->getBrowserPath($this->packages->getUrl($avatar), self::IMAGINE_FILTER);
        }

        $theme->setAvatarCropped($avatar);
    }
}