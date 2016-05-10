<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cubemeets\CubemeetRepository;
use App\Cubemeets\Attendees\Attendee;

class CubemeetAttendeesController extends Controller
{
    /**
     * @var \App\Cubemeets\CubemeetRepository
     */
    protected $cubemeets;

    /**
     * @param \App\Cubemeets\CubemeetRepository $cubemeets
     * @return void
     */
    public function __construct(CubemeetRepository $cubemeets)
    {
        $this->cubemeets = $cubemeets;
    }

    public function join($id)
    {
        $cubemeet = $this->cubemeets->getById($id);

        $cuber = (new Attendee([
            'user_id' => Auth::user()->id,
            'status' => 'Going',
        ]))->toArray();

        $cubemeet->cubers()->updateOrCreate(['user_id' => Auth::user()->id], $cuber);

        return Redirect::back()->with('success', 'Successfuly joined');
    }

    public function canceljoin($id)
    {
        $cubemeet = $this->cubemeets->getById($id);

        $cubemeet->cubers()->where('user_id', Auth::user()->id)->update(['status' => 'Not Going']);

        return Redirect::back()->with('success', 'Success');
    }
}
