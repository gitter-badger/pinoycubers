<?php

namespace App\Cubemeets;

use App\Repository;

class CubemeetRepository extends Repository
{
    /**
     * @var \App\Cubemeets\Cubemeet
     */
    protected $model;

    /**
     * @param \App\Cubemeets\Cubemeet $model
     */
    public function __construct(Cubemeet $model)
    {
        $this->model = $model;
    }
}
