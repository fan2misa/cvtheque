<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Media;
use App\Service\Media\Provider\ImageProvider;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;

final class MediaAdminController extends CRUDController
{

    public function browserAction(Request $request, ImageProvider $imageProvider)
    {
        $medias = $imageProvider->find();

        return $this->renderWithExtraParams('admin/custom/media/browser.html.twig', [
            'medias' => $medias,
            'CKEditor' => $request->get('CKEditor'),
            'CKEditorFuncNum' => $request->get('CKEditorFuncNum'),
            'langCode' => $request->get('langCode'),
        ]);
    }
}
