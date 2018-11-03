<?php

namespace App\Controller\Cv;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PartageController extends AbstractController
{

    public function index()
    {
        return $this->render('cv/partage.html.twig', [
            'controller_name' => 'PartageController',
        ]);
    }
}
