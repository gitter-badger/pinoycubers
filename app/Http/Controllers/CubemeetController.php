<?php

namespace App\Http\Controllers;

use Auth, Redirect, Request, View;
use App\Cubemeet;
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
        $cms = Cubemeet::with('host')->orderBy('date')->get()->toArray();

        return View::make('cubemeet.index', compact('cms'));
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
        $cubemeet = new Cubemeet(Request::all());

        $cubemeet['status'] = 'scheduled';

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
        $cm = Cubemeet::with('host')->findOrFail($id)->toArray();

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
