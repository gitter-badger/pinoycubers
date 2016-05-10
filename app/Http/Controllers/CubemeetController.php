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

class CubemeetController extends Controller
{
    /**
     * @var \App\Cubemeets\CubemeetRepository
     */
    protected $cubemeets;

    protected $cubemeetsPerPage = 15;

    /**
     * @param \App\Cubemeet\CubemeetRepository $cubemeets
     * @return void
     */
    public function __construct(CubemeetRepository $cubemeets)
    {
        $this->cubemeets = $cubemeets;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cubemeets = $this->cubemeetRepository->getAllPaginated($this->cubemeetsPerPage);

        return View::make('cubemeets.index', compact('cubemeets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('cubemeets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CubemeetRequest $request
     * @return Response
     */
    public function store(CubemeetRequest $request)
    {
        $cubemeet = new Cubemeet;
        $cubemeet['name'] = $request['name'];
        $cubemeet['location'] = $request['location'];
        $cubemeet['description'] = $request['description'];
        $cubemeet['date'] = Carbon::create($request['year'], $request['month'], $request['day']);
        $cubemeet['start_time'] = $request['time'];
        $cubemeet['status'] = 'Scheduled';

        Auth::user()->cubemeets()->save($cubemeet);

        return Redirect::to('cubemeets')->with('success', 'Cube Meet successfuly scheduled');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $cm = Cubemeet::with('host', 'cubers.cuberprofile')->findOrFail($id);

        return View::make('cubemeets.show', compact('cm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $cubemeet = Cubemeet::findOrFail($id);
        return View::make('cubemeets.edit', compact('cubemeet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param CubemeetRequest $request
     * @return Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
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
}
