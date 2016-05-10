<?php

namespace App\Cubemeets\Attendee;

class AttendeeUpdater
{
    /**
     * @var \App\Cubemeets\Attendees\AttendeeRepository
     */
    protected $attendees;

    /**
     * @param \App\Cubemeets\Attendees\AttendeeRepository $attendees
     */
    public function __construct(CubemeetRepository $attendees)
    {
        $this->attendees = $attendees;
    }

    public function cancelAttendance($listener, $attendee)
    {
        $attendee->status = 'Not Going';

        $this->attendees->save($attendee);

        return $listener->attendanceCanceled();
    }
}
