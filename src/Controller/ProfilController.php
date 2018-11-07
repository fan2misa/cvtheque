<?php

namespace App\Controller;

use App\Form\UserType;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ProfilController extends AbstractController {

    public function index(Request $request, UserService $userService) {

        $form = $this->createForm(UserType::class, $this->getUser());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userService->save($this->getUser());
            $this->addFlash('success', 'Votre profil a été modifié');
            return $this->redirectToRoute('profil');
        }

        return $this->render('profil/index.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

}
