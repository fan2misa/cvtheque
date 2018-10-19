<?php

namespace App\Twig;

use App\Service\ContactService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ContactExtension extends AbstractExtension {

    private $contactService;

    public function __construct(ContactService $contactService) {
        $this->contactService = $contactService;
    }

    public function getFilters(): array {
        return [
            new TwigFilter('contact_icon_class', [$this->contactService, 'getIconClass']),
        ];
    }

}
