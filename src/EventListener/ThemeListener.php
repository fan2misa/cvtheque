<?php

namespace App\EventListener;

use App\Entity\Theme;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Filesystem\Filesystem;

class ThemeListener
{

    private $packages;

    private $imagineCacheManager;

    private $publicPath;

    private $parameters;

    private $fileSystem;

    const IMAGINE_FILTER = 'theme_avatar';

    public function __construct(Packages $packages, CacheManager $imagineCacheManager, $public_path, $parameters) {
        $this->packages = $packages;
        $this->imagineCacheManager = $imagineCacheManager;
        $this->publicPath = $public_path;
        $this->parameters = $parameters;
        $this->fileSystem = new Filesystem();
    }

    public function postLoad(Theme $theme, LifecycleEventArgs $event)
    {
        $avatar = null !== $theme->getAvatar() ? $theme->getAvatar() : $this->parameters['default'];

        if (!preg_match('/^(http|https)/', $avatar)) {
            $avatar = $this->imagineCacheManager->getBrowserPath($this->packages->getUrl($avatar), self::IMAGINE_FILTER);
        }

        $theme->setAvatarCropped($avatar);
    }
}