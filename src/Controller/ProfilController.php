<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController {

    /**
     * @Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted("ROLE_USER")
     */
    public function index() {
        return $this->render('profil/index.html.twig', [
                    'controller_name' => 'ProfilController',
        ]);
    }

}
