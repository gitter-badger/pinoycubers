<?php

namespace App\Http\Controllers;

use Auth, Redirect, Request, View, Validator;
use App\Cubemeets\Cubemeet;
use App\Cubemeets\CMCuber;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Requests\CubemeetRequest;
use App\Http\Controllers\Controller;
use App\Cubemeets\CubemeetRepository;
use App\Cubemeets\CubemeetCreator;
use App\Cubemeets\CubemeetCreatorListener;

class CubemeetController extends Controller implements CubemeetCreatorListener
{
    /**
     * @var \App\Cubemeets\CubemeetRepository
     */
    protected $cubemeets;

    /**
     * @var \App\Cubemeets\CubemeetCreator
     */
    protected $cubemeetCreator;

    protected $cubemeetsPerPage = 15;

    /**
     * @param \App\Cubemeet\CubemeetRepository $cubemeets
     * @param \App\Cubemeet\CubemeetCreator $cubemeetCreator
     * @return void
     */
    public function __construct(CubemeetRepository $cubemeets, CubemeetCreator $cubemeetCreator)
    {
        $this->cubemeets = $cubemeets;
        $this->cubemeetCreator = $cubemeetCreator;
    }

    public function index()
    {
        $cubemeets = $this->cubemeets->getAllPaginated($this->cubemeetsPerPage);

        return View::make('cubemeets.index', compact('cubemeets'));
    }

    public function create()
    {
        return View::make('cubemeets.create');
    }

    /**
     * @param CubemeetRequest $request
     * @return Response
     */
    public function store(CubemeetRequest $request)
    {
        $data = $request->except(['year', 'month', 'day']);
        $data['date'] = Carbon::create($request->year, $request->month, $request->day);
        $data['host'] = $request->user()->id;

        return $this->cubemeetCreator->create($this, $data);
    }

    public function show($id)
    {
        $cm = Cubemeet::with('host', 'cubers.cuberprofile')->findOrFail($id);

        return View::make('cubemeets.show', compact('cm'));
    }

    public function edit($id)
    {
        $cubemeet = Cubemeet::findOrFail($id);
        return View::make('cubemeets.edit', compact('cubemeet'));
    }

    public function update($id, CubemeetRequest $request)
    {
        $cubemeet = Cubemeet::findOrFail($id);

        $input = [
            'name' => $request['name'],
            'location' => $request['location'],
            'description' => $request['description'],
            'date' => Carbon::create($request['year'], $request['month'], $request['day']),
            'start_time' => $request['time'],
            'status' => 'Scheduled',
        ];

        $cubemeet->fill($input)->save();

        return Redirect::to('cubemeets')->with('success', 'Cube Meet successfuly updated');
    }

    public function cancel($id)
    {
        $cubemeet = Cubemeet::findOrFail($id);

        $input = Request::all();
        $cubemeet['status'] = 'Canceled';

        $cubemeet->fill($input)->save();

        return Redirect::to('cubemeets')->with('success', 'Cube Meet successfuly canceled');
    }

    public function join($id)
    {
        $cubemeet = Cubemeet::findOrFail($id);

        $cuber = (new CMCuber([
            'user_id' => Auth::user()->id,
            'status' => 'Going',
        ]))->toArray();

        $cubemeet->cubers()->updateOrCreate(['user_id' => Auth::user()->id], $cuber);

        return Redirect::back()->with('success', 'Successfuly joined');
    }

    public function canceljoin($id)
    {
        $cubemeet = Cubemeet::findOrFail($id);

        $cubemeet->cubers()->where('user_id', Auth::user()->id)->update(['status' => 'Not Going']);

        return Redirect::back()->with('success', 'Success');
    }

    public function cubemeetCreated()
    {
        return Redirect::to('cubemeets')->with('success', 'Cube Meet successfuly scheduled');
    }
}
