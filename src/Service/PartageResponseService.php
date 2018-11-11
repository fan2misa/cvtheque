<?php

namespace App\Service;

use App\Entity\Cv;
use App\Service\Wrapper\CvWrapperService;

class PartageResponseService {

    private $cvWrapperService;

    private $partageResponses;

    public function __construct(CvWrapperService $cvWrapperService)
    {
        $this->cvWrapperService = $cvWrapperService;
        $this->partageResponses = [];
    }

    /**
     * @return Registry
     */
    public function addPartageResponse(PartageResponse $partageResponse, string $extension): self {
        if (isset($this->parameters)) {
            throw new \Exception("A partage response with extension $extension already exist!");
        }
        $this->partageResponses[$extension] = $partageResponse;

        return $this;
    }

    /**
     * @return Registry
     */
    public function getPartageResponse($extension): PartageResponse {
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
        return $this->getPartageResponse($extension)->render($this->cvWrapperService->generateWrapper($cv));
    }
}