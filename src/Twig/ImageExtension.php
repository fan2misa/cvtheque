<?php

namespace App\Twig;

use App\Entity\Media;
use Symfony\Component\Asset\Packages;
use App\Service\ImageManager;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class ImageExtension extends AbstractExtension
{
    private $imageManager;

    private $packages;

    public function __construct(ImageManager $imageManager, Packages $packages)
    {
        $this->imageManager = $imageManager;
        $this->packages = $packages;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('image_resize', [$this, 'resize']),
            new TwigFilter('media_resize', [$this, 'mediaResize']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('image_resize', [$this, 'resize']),
            new TwigFunction('media_resize', [$this, 'mediaResize']),
        ];
    }

    public function resize($path, $filter)
    {
        if (null !== $path) {
            return $this->packages->getUrl($this->imageManager->get($path, $filter));
        }

        return $path;
    }

    public function mediaResize(Media $media, $filter)
    {
        return $this->resize($media->getPath(), $filter);
    }
}
