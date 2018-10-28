<?php

namespace App\Controller;

use App\Entity\Theme;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ThemeController extends AbstractController
{

    public function list(SerializerInterface $serializer)
    {
        $themes = $this->getDoctrine()->getRepository(Theme::class)->findAll();

        return new JsonResponse([
            'themes' => $serializer->normalize($themes, 'json', ['attributes' => ['id', 'nom', 'description', 'avatar', 'slug']])
        ]);
    }
}
