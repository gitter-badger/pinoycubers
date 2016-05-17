<?php

namespace App\Cubemeets\Comments;

class CommentDeleter
{
    /**
     * @var \App\Cubemeets\Comments\CommentRepository
     */
    protected $comments;

    /**
     * @param \App\Cubemeets\Comments\CommentRepository $comments
     */
    public function __construct(CommentRepository $comments)
    {
        $this->comments = $comments;
    }

    public function delete($listener, $comment)
    {
        $fromCubemeet = $comment->getCubemeet();

        $this->comments->delete($comment);

        return $listener->commentDeleted($fromCubemeet);
    }
}
