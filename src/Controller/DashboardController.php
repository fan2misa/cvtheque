<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController {

    /**
     * @Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted("ROLE_USER")
     */
    public function index() {
        return $this->render('dashboard/index.html.twig', [
                    'controller_name' => 'DashboardController',
        ]);
    }

}
