<?php

namespace App\Service;

use App\Entity\Cv;

class PartageResponseService {

    private $partageResponses;

    public function __construct()
    {
        $this->partageResponses = [];
    }

    /**
     * @return Registry
     */
    public function addPartageResponse(PartageResponseInterface $partageResponse, string $extension): self {
        if (isset($this->parameters)) {
            throw new \Exception("A partage response with extension $extension already exist!");
        }
        $this->partageResponses[$extension] = $partageResponse;

        return $this;
    }

    /**
     * @return Registry
     */
    public function getPartageResponse($extension): PartageResponseInterface {
        if (!isset($this->partageResponses[$extension])) {
            throw new \Exception("A partage response with extension $extension does not exist!");
        }
        return $this->partageResponses[$extension];
    }

    /**
     * @return mixed
     */
    public function render(Cv $cv, $extension)
    {
        return $this->getPartageResponse($extension)->render($cv);
    }
}