<?php

namespace App\Controller\Cv;

use App\Entity\Cv;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PartageController extends AbstractController
{

    public function index(Cv $cv)
    {
        return $this->render('cv/partage.html.twig', [
            'cv' => $cv,
        ]);
    }
}
