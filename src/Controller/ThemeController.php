<?php

namespace App\Controller;

use App\Entity\Cv;
use App\Entity\Theme;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class ThemeController extends AbstractController
{

    public function list(Request $request, SerializerInterface $serializer)
    {
        $themes = $this->getDoctrine()->getRepository(Theme::class)->findAll();

        return new JsonResponse([
            'cv' => $request->get('cv'),
            'themes' => $serializer->normalize($themes, 'json', ['attributes' => ['id', 'nom', 'description', 'avatarCropped', 'slug']])
        ]);
    }

    public function change(Request $request)
    {
        $cv = $this->getDoctrine()->getRepository(Cv::class)->find($request->get('cv_id'));

        if ($cv->getUser() != $this->getUser()) {
            return $this->createNotFoundException("You can change CV's theme of other user !");
        }

        $theme = $this->getDoctrine()->getRepository(Theme::class)->find($request->get('theme_id'));

        $cv->setTheme($theme);

        $this->getDoctrine()->getManager()->persist($cv);
        $this->getDoctrine()->getManager()->flush();

        $this->addFlash('success', 'Le thème de votre Cv a été modifié');
        return $this->redirectToRoute('cv_modifier', ['id' => $cv->getId()]);
    }
}
