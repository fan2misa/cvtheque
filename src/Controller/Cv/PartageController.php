<?php

namespace App\Controller\Cv;

use App\Entity\Cv;
use App\Service\PartageResponseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PartageController extends AbstractController
{

    public function index(PartageResponseService $partageResponseService, Cv $cv, $extension)
    {
        return $partageResponseService->render($cv, $extension);
    }
}
