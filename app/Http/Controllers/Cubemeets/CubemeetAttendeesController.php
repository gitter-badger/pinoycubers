<?php

namespace App\Http\Controllers\Cubemeets;

use Auth;
use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cubemeets\CubemeetRepository;
use App\Cubemeets\Attendees\Attendee;
use App\Cubemeets\Attendees\AttendeeCreator;
use App\Cubemeets\Attendees\AttendeeCreatorListener;

class CubemeetAttendeesController extends Controller implements AttendeeCreatorListener
{
    /**
     * @var \App\Cubemeets\CubemeetRepository
     */
    protected $cubemeets;

    /**
     * @var \App\Cubemeets\Attendees\AttendeeCreator
     */
    protected $attendeeCreator;

    /**
     * @param \App\Cubemeets\CubemeetRepository $cubemeets
     * @return void
     */
    public function __construct(CubemeetRepository $cubemeets, AttendeeCreator $attendeeCreator)
    {
        $this->cubemeets = $cubemeets;
        $this->attendeeCreator = $attendeeCreator;
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

    public function canceljoin($id)
    {
        $cubemeet = $this->cubemeets->getById($id);

        $cubemeet->cubers()->where('user_id', Auth::user()->id)->update(['status' => 'Not Going']);

        return Redirect::back()->with('success', 'Success');
    }

    public function attendeeCreated()
    {
        return Redirect::back()->with('success', 'Successfuly joined');
    }
}
