<?php

namespace App\Http\Controllers\Cubemeets;

use App\Cubemeets\CubemeetRepository;
use App\Cubemeets\Comments\CommentCreator;
use App\Cubemeets\Comments\CommentCreatorListener;
use App\Cubemeets\Comments\CommentRepository;
use App\Cubemeets\Comments\CommentUpdater;
use App\Cubemeets\Comments\CommentUpdaterListener;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use View;

class CubemeetCommentController extends Controller implements CommentCreatorListener, CommentUpdaterListener
{
    /**
     * @var \App\Cubemeets\CubemeetRepository
     */
    protected $cubemeets;

    /**
     * @var \App\Cubemeets\Comments\CommentRepository
     */
    protected $comments;

    /**
     * @var \App\Cubemeets\Comments\CommentCreator
     */
    protected $commentCreator;

    /**
     * @var \App\Cubemeets\Comments\CommentUpdater
     */
    protected $commentUpdater;

    /**
     * @param \App\Cubemeets\CubemeetRepository $cubemeets
     * @param \App\Cubemeets\Comments\CommentRepository $comments
     * @param \App\Cubemeets\Comments\CommentCreator $commentCreator
     * @param \App\Cubemeets\Comments\CommentUpdater $commentUpdater
     */
    public function __construct(CubemeetRepository $cubemeets, CommentRepository $comments, CommentCreator $commentCreator, CommentUpdater $commentUpdater)
    {
        $this->cubemeets = $cubemeets;
        $this->comments = $comments;
        $this->commentCreator = $commentCreator;
        $this->commentUpdater = $commentUpdater;
    }

    public function comment($slug, Request $request)
    {
        $cubemeet = $this->cubemeets->getBySlug($slug);

        $data = [
            'user_id' => $request->user()->id,
            'cm_id' => $cubemeet->id,
            'comment' => $request->get('comment')
        ];

        return $this->commentCreator->create($this, $data);
    }

    public function edit($id)
    {
        $comment = $this->comments->getById($id);

        return View::make('cubemeets.comments.edit', compact('comment'));
    }

    public function update($id, Request $request)
    {
        $comment = $this->comments->getById($id);

        $data = ['comment' => $request->comment];

        return $this->commentUpdater->update($this, $comment, $data);
    }

    public function commentCreated()
    {
        return Redirect::back();
    }

    public function commentUpdated($comment)
    {
        $cubemeet = $comment->getCubemeet();

        return Redirect::to('cubemeets/'.$cubemeet->slug)->with('success', 'Comment updated');
    }
}
