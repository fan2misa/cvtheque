<?php

namespace App\Controller\Cv;

use App\Form\CVAjouterType;
use App\Service\CVService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AjouterController extends AbstractController {

    public function index(CVService $cvService, Request $request) {
        $cv = $cvService->create();

        $form = $this->createForm(CVAjouterType::class, $cv);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $cv->setUser($this->getUser());
                $cvService->save($cv);

                $this->addFlash('success', 'Votre Cv a été ajouté');
                return $this->redirectToRoute('cv_modifier', ['id' => $cv->getId()]);
            } else {
                return $this->render('dashboard/index.html.twig', [
                    'form' => $form->createView(),
                    'open_modal' => "#modal-ajouter-cv"
                ]);
            }
        }

        throw $this->createNotFoundException();
    }

}
