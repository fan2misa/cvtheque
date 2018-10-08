<?php

namespace App\Controller;

use App\Enum\RoleEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class HomeController extends AbstractController {

    public function index(AuthorizationCheckerInterface $authChecker) {

        if ($authChecker->isGranted(RoleEnum::ROLE_USER)) {
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('home/index.html.twig', [
                    'controller_name' => 'HomeController',
        ]);
    }

}
