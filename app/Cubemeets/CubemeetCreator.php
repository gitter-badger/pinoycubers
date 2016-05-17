<?php

namespace App\Cubemeets;

class CubemeetCreator
{
    /**
     * @var \App\Cubemeets\CubemeetRepository
     */
    protected $cubemeets;

    /**
     * @param \App\Cubemeets\CubemeetRepository $cubemeets
     */
    public function __construct(CubemeetRepository $cubemeets)
    {
        $this->cubemeets = $cubemeets;
    }

    public function create($listener, $data)
    {
        $cubemeet = $this->cubemeets->getNew($data);
        $cubemeet->status = 'Scheduled';
        $cubemeet->slug = $this->createSlug($cubemeet->name);

        $this->cubemeets->save($cubemeet);

        return $listener->cubemeetCreated();
    }

    public function createSlug($name)
    {
        $slug = str_slug($name);

        $count = $this->cubemeets->countSameSlug($slug);

        return $count ? "{$slug}-{$count}" : $slug;
    }
}
