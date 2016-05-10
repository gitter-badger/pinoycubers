<?php

namespace App\Cubemeets;

interface CubemeetUpdaterListener
{
    public function cubemeetUpdated();
    public function cubemeetCanceled();
}
