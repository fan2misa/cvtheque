<?php

namespace App\Service;

use App\Entity\Cv;

interface PartageResponseInterface {

    public function render(Cv $cv);

}