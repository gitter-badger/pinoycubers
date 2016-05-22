<?php

namespace App\Market\Items;

use App\Repository;

class ItemRepository extends Repository
{
	/**
     * @var \App\Market\Item
     */
    protected $model;

    /**
     * @param \App\Market\Item $model
     */
    public function __construct(Item $model)
    {
        $this->model = $model;
    }

    public function countSameSlug($slug)
    {
        return $this->model->whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
    }

    public function getBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }
}
