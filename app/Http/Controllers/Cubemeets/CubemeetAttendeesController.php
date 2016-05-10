<?php

namespace App\Http\Controllers\Cubemeets;

use App\Cubemeets\Attendees\AttendeeCreator;
use App\Cubemeets\Attendees\AttendeeCreatorListener;
use App\Cubemeets\Attendees\AttendeeRepository;
use App\Cubemeets\Attendees\AttendeeUpdater;
use App\Cubemeets\Attendees\AttendeeUpdaterListener;
use App\Cubemeets\CubemeetRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;

class CubemeetAttendeesController extends Controller implements AttendeeCreatorListener, AttendeeUpdaterListener
{
    /**
     * @var \App\Cubemeets\CubemeetRepository
     */
    protected $cubemeets;

    /**
     * @var \App\Cubemeets\AttendeeRepository
     */
    protected $attendees;

    /**
     * @var \App\Cubemeets\Attendees\AttendeeCreator
     */
    protected $attendeeCreator;

    /**
     * @var \App\Cubemeets\Attendees\AttendeeUpdater
     */
    protected $attendeeUpdater;

    /**
     * @param \App\Cubemeets\CubemeetRepository $cubemeets
     * @param \App\Cubemeets\Attendees\AttendeeRepository $attendees
     * @param \App\Cubemeets\Attendees\AttendeeCreator $attendeeCreator
     * @param \App\Cubemeets\Attendees\AttendeeUpdater $attendeeUpdater
     * @return void
     */
    public function __construct(CubemeetRepository $cubemeets, AttendeeRepository $attendees, AttendeeCreator $attendeeCreator, AttendeeUpdater $attendeeUpdater)
    {
        $this->cubemeets = $cubemeets;
        $this->attendees = $attendees;
        $this->attendeeCreator = $attendeeCreator;
        $this->attendeeUpdater = $attendeeUpdater;
    }

    public function join($id, Request $request)
    {
        $cubemeet = $this->cubemeets->getById($id);

        $data = [
            'cm_id' => $cubemeet->id,
            'user_id' => $request->user()->id
        ];

        return $this->attendeeCreator->create($this, $data);
    }

    public function cancelJoin($id, Request $request)
    {
        $cubemeet = $this->cubemeets->getById($id);

        $user_id = $request->user()->id;

        $attendee = $this->attendees->getByIdFromCubemeet($user_id, $cubemeet);

        return $this->attendeeUpdater->cancelAttendance($this, $attendee);
    }

    public function attendeeCreated()
    {
        return Redirect::back()->with('success', 'Successfuly joined');
    }

    public function attendanceCanceled()
    {
        return Redirect::back()->with('success', 'Success');
    }
}
