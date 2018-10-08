<?php

namespace App\Controller;

use App\Enum\RoleEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ConnexionController extends AbstractController {

    /**
     * @Route("/connexion", name="connexion")
     */
    public function index(AuthenticationUtils $authenticationUtils, AuthorizationCheckerInterface $authChecker) {
        
        if ($authChecker->isGranted(RoleEnum::ROLE_USER)) {
            return $this->redirectToRoute('dashboard');
        }
        
        return $this->render('connexion/index.html.twig', [
                    'last_username' => $authenticationUtils->getLastUsername(),
                    'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

}
