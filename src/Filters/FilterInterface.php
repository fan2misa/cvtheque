<?php

namespace App\Filters;

use Intervention\Image\Filters\FilterInterface as InterventionFilterInterface;

interface FilterInterface extends InterventionFilterInterface
{
    public function getFoldername();
}