<?php

namespace App\Cubemeets\Attendees;

class AttendeeCreator
{
    /**
     * @var \App\Cubemeets\Attendees\AttendeeRepository
     */
    protected $attendees;

    /**
     * @param \App\Cubemeets\Attendees\AttendeeRepository $attendees
     */
    public function __construct(AttendeeRepository $attendees)
    {
        $this->attendees = $attendees;
    }

    public function create($listener, $data)
    {
        $attendee = $this->attendees->getNew($data);
        
        $this->attendees->save($attendee);

        return $listener->attendeeCreated();
    }
}
