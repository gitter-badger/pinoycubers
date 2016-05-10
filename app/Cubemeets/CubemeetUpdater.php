<?php

namespace App\Cubemeets;

class CubemeetUpdater
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

    public function update($listener, $cubemeet, $data)
    {
        $cubemeet->fill($data);

        $this->cubemeets->save($cubemeet);

        return $listener->cubemeetUpdated();
    }

    public function cancel($listener, $cubemeet)
    {
        $cubemeet->status = 'Canceled';

        $this->cubemeets->save($cubemeet);

        return $listener->cubemeetCanceled();
    }
}
