<?php

namespace App\Http\Controllers\Cubemeets;

use App\Cubemeets\CubemeetCreator;
use App\Cubemeets\CubemeetCreatorListener;
use App\Cubemeets\CubemeetRepository;
use App\Cubemeets\CubemeetUpdater;
use App\Cubemeets\CubemeetUpdaterListener;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostCubemeetRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use View;

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

    protected $commentsPerPage = 15;

    /**
     * @param \App\Cubemeets\CubemeetRepository $cubemeets
     * @param \App\Cubemeets\CubemeetCreator $cubemeetCreator
     * @param \App\Cubemeets\CubemeetUpdater $cubemeetUpdater
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

    public function show($slug)
    {
        $cm = $this->cubemeets->getBySlug($slug);

        $comments = $this->cubemeets->getCubemeetCommentsPaginated($cm, $this->commentsPerPage);

        return View::make('cubemeets.show', compact('cm', 'comments'));
    }

    public function edit($slug, Request $request)
    {
        $cubemeet = $this->cubemeets->getBySlug($slug);

        if($cubemeet->isManageableBy($request->user()))
        {
            return View::make('cubemeets.edit', compact('cubemeet'));
        }

        return $this->actionNotAllowed();
    }

    public function update($slug, PostCubemeetRequest $request)
    {
        $cubemeet = $this->cubemeets->getBySlug($slug);

        if($cubemeet->isManageableBy($request->user()))
        {
            $data = $this->prepareDataFromRequest($request);

            return $this->cubemeetUpdater->update($this, $cubemeet, $data);
        }

        return $this->actionNotAllowed();
    }

    private function prepareDataFromRequest($request)
    {
        $data = $request->except(['year', 'month', 'day']);
        $data['date'] = Carbon::create($request->year, $request->month, $request->day);
        $data['user_id'] = $request->user()->id;

        return $data;
    }

    public function getCancel($slug, Request $request)
    {
        $cubemeet = $this->cubemeets->getBySlug($slug);

        if($cubemeet->isManageableBy($request->user()))
        {
            return View::make('cubemeets.cancel', compact('cubemeet'));
        }

        return $this->actionNotAllowed();
    }

    public function cancel($slug, Request $request)
    {
        $cubemeet = $this->cubemeets->getBySlug($slug);

        if($cubemeet->isManageableBy($request->user()))
        {
            $reason = $request->get('reason');

            return $this->cubemeetUpdater->cancel($this, $cubemeet, $reason);
        }

        return $this->actionNotAllowed();
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

    public function actionNotAllowed()
    {
        return Redirect::to('cubemeets');
    }
}
