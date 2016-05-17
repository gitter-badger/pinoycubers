<?php

namespace App\Http\Controllers\Cubemeets;

use App\Cubemeets\CubemeetRepository;
use App\Cubemeets\Comments\CommentCreator;
use App\Cubemeets\Comments\CommentCreatorListener;
use App\Cubemeets\Comments\CommentDeleter;
use App\Cubemeets\Comments\CommentDeleterListener;
use App\Cubemeets\Comments\CommentRepository;
use App\Cubemeets\Comments\CommentUpdater;
use App\Cubemeets\Comments\CommentUpdaterListener;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cubemeets\PostCubemeetCommentRequest;
use Illuminate\Http\Request;
use Redirect;
use View;

class CubemeetCommentController extends Controller implements CommentCreatorListener, CommentUpdaterListener, CommentDeleterListener
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
     * @var \App\Cubemeets\Comments\CommentDeleter
     */
    protected $commentDeleter;

    /**
     * @param \App\Cubemeets\CubemeetRepository $cubemeets
     * @param \App\Cubemeets\Comments\CommentRepository $comments
     * @param \App\Cubemeets\Comments\CommentCreator $commentCreator
     * @param \App\Cubemeets\Comments\CommentUpdater $commentUpdater
     * @param \App\Cubemeets\Comments\CommentDeleter $commentDeleter
     */
    public function __construct(CubemeetRepository $cubemeets, CommentRepository $comments, CommentCreator $commentCreator, CommentUpdater $commentUpdater, CommentDeleter $commentDeleter)
    {
        $this->cubemeets = $cubemeets;
        $this->comments = $comments;
        $this->commentCreator = $commentCreator;
        $this->commentUpdater = $commentUpdater;
        $this->commentDeleter = $commentDeleter;
    }

    public function comment($slug, PostCubemeetCommentRequest $request)
    {
        $cubemeet = $this->cubemeets->getBySlug($slug);

        $data = [
            'user_id' => $request->user()->id,
            'cm_id' => $cubemeet->id,
            'comment' => $request->get('comment')
        ];

        return $this->commentCreator->create($this, $data);
    }

    public function edit($id, Request $request)
    {
        $comment = $this->comments->getById($id);

        if($comment->isManageableBy($request->user()))
        {
            return View::make('cubemeets.comments.edit', compact('comment'));
        }

        return $this->actionNotAllowed();
    }

    public function update($id, PostCubemeetCommentRequest $request)
    {
        $comment = $this->comments->getById($id);

        if($comment->isManageableBy($request->user()))
        {
            $data = ['comment' => $request->comment];

            return $this->commentUpdater->update($this, $comment, $data);
        }

        return $this->actionNotAllowed();
    }

    public function getDelete($id, Request $request)
    {
        $comment = $this->comments->getById($id);

        if($comment->isManageableBy($request->user()))
        {
            return View::make('cubemeets.comments.delete', compact('comment'));
        }

        return $this->actionNotAllowed();
    }

    public function postDelete($id, Request $request)
    {
        $comment = $this->comments->getById($id);

        if($comment->isManageableBy($request->user()))
        {
            return $this->commentDeleter->delete($this, $comment);
        }

        return $this->actionNotAllowed();
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

    public function commentDeleted($fromCubemeet)
    {
        return Redirect::to('cubemeets/'.$fromCubemeet->slug)->with('success', 'Comment deleted');
    }

    public function actionNotAllowed()
    {
        return Redirect::to('cubemeets');
    }
}
