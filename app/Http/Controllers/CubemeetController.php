<?php

namespace App\Http\Controllers;

use Auth, Redirect, Request, View;
use App\Cubemeet;
use App\CMCuber;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CubemeetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $upcoming = Cubemeet::with('host', 'cubers')->where('status', 'Scheduled')->orderBy('date')->get()->toArray();
        $canceled = Cubemeet::with('host')->where('status', 'Canceled')->orderBy('date')->get()->toArray();

        return View::make('cubemeet.index', compact('upcoming', 'canceled'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('cubemeet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $request = Request::all();

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
        $cm = Cubemeet::with('host', 'cubers')->findOrFail($id)->toArray();

        return View::make('cubemeet.show', compact('cm'));
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
        return View::make('cubemeet.edit', compact('cubemeet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $cubemeet = Cubemeet::findOrFail($id);

        $input = Request::all();
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

        $cubemeet->cubers()->update(['status' => 'Not Going']);

        return Redirect::back()->with('success', 'Success');
    }
}
