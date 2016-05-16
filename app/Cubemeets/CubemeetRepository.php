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

    public function getById($id)
    {
        return $this->model->with('host', 'cubers.cuberprofile')->where('id', '=', $id)->first();
    }

    public function countSameSlug($slug)
    {
        return $this->model->whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
    }
}
