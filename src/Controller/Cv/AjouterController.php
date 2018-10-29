<?php

namespace App\Controller\Cv;

use App\Entity\Cv;
use App\Form\CVType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AjouterController extends AbstractController {

    public function index(Request $request) {
        $cv = new Cv();

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
