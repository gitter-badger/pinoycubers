<?php

namespace App\Http\Controllers\Cubemeets;

use App\Cubemeets\CubemeetRepository;
use App\Cubemeets\Comments\CommentCreator;
use App\Cubemeets\Comments\CommentCreatorListener;
use App\Cubemeets\Comments\CommentRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;

class CubemeetCommentController extends Controller implements CommentCreatorListener
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
     * @param \App\Cubemeets\CubemeetRepository $cubemeets
     * @param \App\Cubemeets\Comments\CommentRepository $comments
     * @param \App\Cubemeets\Comments\CommentCreator $commentCreator
     */
    public function __construct(CubemeetRepository $cubemeets, CommentRepository $comments, CommentCreator $commentCreator)
    {
        $this->cubemeets = $cubemeets;
        $this->comments = $comments;
        $this->commentCreator = $commentCreator;
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

    public function commentCreated()
    {
        return Redirect::back();
    }
}
