<?php

namespace App\Service;

use App\Service\Wrapper\Entity\Cv;

abstract class PartageResponse {

    public abstract function render(Cv $cv);

}