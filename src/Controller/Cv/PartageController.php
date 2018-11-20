<?php

namespace App\Controller\Cv;

use App\Entity\Cv;
use App\Entity\User;
use App\Service\PartageResponseService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PartageController extends AbstractController
{

    public function index(PartageResponseService $partageResponseService, Cv $cv, $extension)
    {
        if ($cv->getUser() !== $this->getUser()) {
            throw $this->createNotFoundException("Ce Cv ne vous appartient pas !");
        }

        return $partageResponseService->render($cv, $extension);
    }

    /**
     * @ParamConverter("user", options={"mapping"={"user"="slug"}})
     * @ParamConverter("cv", options={"mapping"={"cv"="slug"}})
     */
    public function public(PartageResponseService $partageResponseService, User $user, Cv $cv, $extension)
    {
        if (!$cv->isActive()) {
            throw $this->createNotFoundException("Ce Cv n'est pas actif !");
        }
        return $partageResponseService->render($cv, $extension);
    }

    public function activation(Request $request, Cv $cv)
    {
        if ($cv->getUser() !== $this->getUser()) {
            throw $this->createNotFoundException("Ce Cv ne vous appartient pas !");
        }

        $cv->setActive(!!$request->get('checked'));
        $this->getDoctrine()->getManager()->persist($cv);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse([
            'success' => true,
            'checked' => $request->get('checked')
        ]);
    }
}
