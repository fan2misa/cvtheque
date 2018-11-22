<?php

namespace App\Controller\Cv;

use App\Entity\Cv;
use App\Form\CVType;
use App\Service\CVService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AjouterController extends AbstractController {

    public function index(CVService $cvService, Request $request) {
        $cv = $cvService->create();

        $form = $this->createForm(CVType::class, $cv);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
        }

        return $this->render('cv/formulaire.html.twig', [
                    'title' => "Créez votre CV",
                    'cv' => $cv,
                    'form' => $form->createView()
        ]);
    }

}
