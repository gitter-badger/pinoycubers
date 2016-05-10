<?php

namespace App\Http\Controllers;

use Auth, Redirect, Request, View, Validator;
use App\Cubemeets\Cubemeet;
use App\Cubemeets\CMCuber;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Requests\PostCubemeetRequest;
use App\Http\Controllers\Controller;
use App\Cubemeets\CubemeetRepository;
use App\Cubemeets\CubemeetCreator;
use App\Cubemeets\CubemeetUpdater;
use App\Cubemeets\CubemeetCreatorListener;
use App\Cubemeets\CubemeetUpdaterListener;

class CubemeetController extends Controller implements CubemeetCreatorListener, CubemeetUpdaterListener
{
    /**
     * @var \App\Cubemeets\CubemeetRepository
     */
    protected $cubemeets;

    /**
     * @var \App\Cubemeets\CubemeetCreator
     */
    protected $cubemeetCreator;

    /**
     * @var \App\Cubemeets\CubemeetUpdater
     */
    protected $cubemeetUpdater;

    protected $cubemeetsPerPage = 15;

    /**
     * @param \App\Cubemeet\CubemeetRepository $cubemeets
     * @param \App\Cubemeet\CubemeetCreator $cubemeetCreator
     * @param \App\Cubemeet\CubemeetUpdater $cubemeetUpdater
     * @return void
     */
    public function __construct(CubemeetRepository $cubemeets, CubemeetCreator $cubemeetCreator, CubemeetUpdater $cubemeetUpdater)
    {
        $this->cubemeets = $cubemeets;
        $this->cubemeetCreator = $cubemeetCreator;
        $this->cubemeetUpdater = $cubemeetUpdater;
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
     * @param PostCubemeetRequest $request
     * @return Response
     */
    public function store(PostCubemeetRequest $request)
    {
        $data = $request->except(['year', 'month', 'day']);
        $data['date'] = Carbon::create($request->year, $request->month, $request->day);
        $data['user_id'] = $request->user()->id;

        return $this->cubemeetCreator->create($this, $data);
    }

    public function show($id)
    {
        $cm = $this->cubemeets->getById($id);

        return View::make('cubemeets.show', compact('cm'));
    }

    public function edit($id)
    {
        $cubemeet = $this->cubemeets->getById($id);

        return View::make('cubemeets.edit', compact('cubemeet'));
    }

    public function update($id, PostCubemeetRequest $request)
    {
        $cubemeet = $this->cubemeets->getById($id);

        $data = $request->except(['year', 'month', 'day']);
        $data['date'] = Carbon::create($request->year, $request->month, $request->day);
        $data['user_id'] = $request->user()->id;

        return $this->cubemeetUpdater->update($this, $cubemeet, $data);
    }

    public function cancel($id)
    {
        $cubemeet = $this->cubemeets->getById($id);

        $input = Request::all();
        $cubemeet['status'] = 'Canceled';

        $cubemeet->fill($input)->save();

        return Redirect::to('cubemeets')->with('success', 'Cube Meet successfuly canceled');
    }

    public function join($id)
    {
        $cubemeet = $this->cubemeets->getById($id);

        $cuber = (new CMCuber([
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

    public function cubemeetCreated()
    {
        return Redirect::to('cubemeets')->with('success', 'Cube Meet successfuly scheduled');
    }

    public function cubemeetUpdated()
    {
        return Redirect::to('cubemeets')->with('success', 'Cube Meet successfuly updated');
    }
}
