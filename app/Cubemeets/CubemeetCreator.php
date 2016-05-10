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

        $this->cubemeets->save($cubemeet);

        return $listener->cubemeetCreated();
    }
}
