<?php

namespace App\Controller\Cv;

use App\Entity\Cv;
use App\Form\CVType;
use App\Service\CVService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ModifierController extends AbstractController {

    public function index(Request $request, CVService $cvService, Cv $cv) {

        $form = $this->createForm(CVType::class, $cv);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cvService->save($cv);
            $this->addFlash('success', 'Votre Cv a été modifié');
            return $this->redirectToRoute('cv_modifier', ['id' => $cv->getId()]);
        }

        return $this->render('cv/formulaire.html.twig', [
                    'title' => "Modifiez votre CV",
                    'cv' => $cv,
                    'form' => $form->createView()
        ]);
    }

}
