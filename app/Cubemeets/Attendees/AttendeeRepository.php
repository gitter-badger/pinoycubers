<?php

namespace App\Cubemeets\Attendees;

use App\Repository;

class AttendeeRepository extends Repository
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

    public function getFromCubemeetById($id, $cubemeet)
    {
        return $cubemeet->cubers()->where('user_id', $id)->first();
    }
}
