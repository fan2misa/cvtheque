<?php

namespace App\Controller;

use App\Form\CVAjouterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController {

    public function index() {

        $form = $this->createForm(CVAjouterType::class);

        return $this->render('dashboard/index.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

}
