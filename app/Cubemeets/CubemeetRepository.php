<?php

namespace App\Cubemeets;

use App\Repository;
use Carbon\Carbon;

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

    public function getBySlug($slug)
    {
        return $this->model->with('host', 'cubers.cuberprofile')->where('slug', '=', $slug)->first();
    }

    public function getCubemeetCommentsPaginated($cubemeet, $perPage = 15)
    {
        return $cubemeet->comments()->paginate($perPage);
    }

    public function getAllTodayPaginated($perPage = 15)
    {
        return $this->model->where('status', 'Scheduled')
                        ->where('date', '=', Carbon::now()->toDateString())
                        ->orderBy('created_at', 'asc')
                        ->paginate($perPage);
    }

    public function getAllNewestPaginated($perPage = 15)
    {
        return $this->model->where('status', 'Scheduled')
                        ->where('date', '>', Carbon::now()->toDateString())
                        ->orderBy('created_at', 'asc')
                        ->paginate($perPage);
    }

    public function getAllUpcomingPaginated($perPage = 15)
    {
        return $this->model->where('status', 'Scheduled')
                        ->where('date', '>', Carbon::now()->toDateString())
                        ->orderBy('date', 'asc')
                        ->paginate($perPage);
    }

    public function getAllCanceledPaginated($perPage = 15)
    {
        return $this->model->where('status', 'Canceled')
                        ->orderBy('date', 'asc')
                        ->paginate($perPage);
    }

    public function getAllPastPaginated($perPage = 15)
    {
        return $this->model->where('status', 'Scheduled')
                        ->where('date', '<', Carbon::now()->toDateString())
                        ->orderBy('date', 'asc')
                        ->paginate($perPage);
    }
}
