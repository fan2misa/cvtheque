<?php

namespace App\EventListener;

use App\Entity\Cv;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Bundle\MakerBundle\Str;

class CvListener
{

    public function prePersist(Cv $cv, LifecycleEventArgs $event)
    {
        $cv->setSlug(Str::asCommand($cv->getNom()));
    }
}