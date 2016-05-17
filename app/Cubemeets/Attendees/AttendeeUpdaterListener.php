<?php

namespace App\Cubemeets\Attendees;

interface AttendeeUpdaterListener
{
    public function attendanceCanceled();
    public function attendanceMarked();
}
