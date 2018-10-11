<?php

namespace App\Twig;

use App\Service\CVService;
use App\Service\UserService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AvatarExtension extends AbstractExtension {

    private $userService;
    
    private $cvService;

    public function __construct(UserService $userService, CVService $cvService) {
        $this->userService = $userService;
        $this->cvService = $cvService;
    }

    public function getFunctions(): array {
        return [
            new TwigFunction('user_avatar', [$this->userService, 'getAvatar']),
            new TwigFunction('cv_avatar', [$this->cvService, 'getAvatar']),
        ];
    }

}
