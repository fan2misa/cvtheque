<?php

namespace App\Controller\CV;

use App\Entity\CV;
use App\Form\CVType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ModifierController extends AbstractController {

    public function index(Request $request, CV $cv) {

        $form = $this->createForm(CVType::class, $cv);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($cv);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Votre CV a été modifié');
            return $this->redirectToRoute('cv_modifier', ['id' => $cv->getId()]);
        }

        return $this->render('cv/cv-modifier.html.twig', [
                    'cv' => $cv,
                    'form' => $form->createView()
        ]);
    }

}
