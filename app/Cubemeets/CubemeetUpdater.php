<?php

namespace App\Cubemeets;

class CubemeetUpdater
{
    /**
     * @var \App\Cubemeets\CubemeetRepository
     */
    protected $cubemeets;

    /**
     * @var \App\Cubemeets\CubemeetCreator
     */
    protected $cubemeetCreator;

    /**
     * @param \App\Cubemeets\CubemeetRepository $cubemeets
     * @param \App\Cubemeets\CubemeetCreator $cubemeetCreator
     */
    public function __construct(CubemeetRepository $cubemeets, CubemeetCreator $cubemeetCreator)
    {
        $this->cubemeets = $cubemeets;
        $this->cubemeetCreator = $cubemeetCreator;
    }

    public function update($listener, $cubemeet, $data)
    {
        $cubemeet->fill($data);

        $cubemeet->slug = $this->cubemeetCreator->createSlug($data['name']);

        $this->cubemeets->save($cubemeet);

        return $listener->cubemeetUpdated();
    }

    public function cancel($listener, $cubemeet, $reason)
    {
        $cubemeet->status = 'Canceled';
        $cubemeet->cancelation_reason = $reason;

        $this->cubemeets->save($cubemeet);

        return $listener->cubemeetCanceled();
    }
}
