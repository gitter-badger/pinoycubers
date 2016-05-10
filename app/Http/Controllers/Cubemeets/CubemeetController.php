<?php

namespace App\Http\Controllers;

use Auth;
use View;
use Request;
use Redirect;
use Validator;
use Carbon\Carbon;
use App\Http\Requests;
use App\Cubemeets\CMCuber;
use App\Cubemeets\Cubemeet;
use App\Cubemeets\CubemeetCreator;
use App\Cubemeets\CubemeetUpdater;
use App\Http\Controllers\Controller;
use App\Cubemeets\CubemeetRepository;
use App\Http\Requests\PostCubemeetRequest;
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
        $data = $this->prepareDataFromRequest($request);

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

        $data = $this->prepareDataFromRequest($request);

        return $this->cubemeetUpdater->update($this, $cubemeet, $data);
    }

    private function prepareDataFromRequest($request)
    {
        $data = $request->except(['year', 'month', 'day']);
        $data['date'] = Carbon::create($request->year, $request->month, $request->day);
        $data['user_id'] = $request->user()->id;

        return $data;
    }

    public function cancel($id)
    {
        $cubemeet = $this->cubemeets->getById($id);

        return $this->cubemeetUpdater->cancel($this, $cubemeet);
    }

    public function cubemeetCreated()
    {
        return Redirect::to('cubemeets')->with('success', 'Cube Meet successfuly scheduled');
    }

    public function cubemeetUpdated()
    {
        return Redirect::to('cubemeets')->with('success', 'Cube Meet successfuly updated');
    }

    public function cubemeetCanceled()
    {
        return Redirect::to('cubemeets')->with('success', 'Cube Meet successfuly canceled');
    }
}
