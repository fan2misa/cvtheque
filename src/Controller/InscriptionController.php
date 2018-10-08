<?php

namespace App\Controller;

use App\Entity\User;
use App\Enum\RoleEnum;
use App\Form\InscriptionFormType;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class InscriptionController extends AbstractController {

    public function index(Request $request, UserService $userService, AuthorizationCheckerInterface $authChecker) {
        
        if ($authChecker->isGranted(RoleEnum::ROLE_USER)) {
            return $this->redirectToRoute('dashboard');
        }
        
        $user = new User();
        $form = $this->createForm(InscriptionFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userService->registration($user);
            $this->addFlash('success', 'Votre inscription a été prise en compte');
            return $this->redirectToRoute('home');
        }

        return $this->render('inscription/index.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

    public function confirmationInscription(Request $request, UserService $userService, $token) {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneByTokenInscription($token);

        if (null === $user) {
            throw $this->createNotFoundException();
        }
        
        $userService->enable($user);
        
        $this->addFlash('success', 'Votre inscription a été confirmé');
        return $this->redirectToRoute('connexion');
    }
}
