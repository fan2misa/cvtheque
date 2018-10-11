<?php

namespace App\Controller\CV;

use App\Entity\CV;
use App\Form\CVType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AjouterController extends AbstractController {

    public function index(Request $request) {
        $cv = new CV();

        $form = $this->createForm(CVType::class, $cv);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
        }

        return $this->render('cv/cv-ajouter.html.twig', [
                    'cv' => $cv,
                    'form' => $form->createView()
        ]);
    }

}
