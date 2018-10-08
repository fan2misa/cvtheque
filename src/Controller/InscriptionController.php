<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionFormType;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController {

    public function index(Request $request, UserService $userService) {
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
