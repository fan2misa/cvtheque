<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ConnexionController extends AbstractController {

    /**
     * @Route("/connexion", name="connexion")
     */
    public function index(AuthenticationUtils $authenticationUtils) {
        return $this->render('connexion/index.html.twig', [
                    'last_username' => $authenticationUtils->getLastUsername(),
                    'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

}
