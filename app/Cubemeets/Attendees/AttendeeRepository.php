<?php

namespace App\Cubemeets\Attendees;

use App\Repository;

class CubemeetRepository extends Repository
{
    /**
     * @var \App\Cubemeets\Attendees\Attendee
     */
    protected $model;

    /**
     * @param \App\Cubemeets\Attendees\Attendee $model
     */
    public function __construct(Attendee $model)
    {
        $this->model = $model;
    }
}
