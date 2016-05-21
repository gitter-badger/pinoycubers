<?php

namespace App\Market\Items\Comments;

class CommentDeleter
{
    /**
     * @var \App\Market\Items\Comments\CommentRepository
     */
    protected $comments;

    /**
     * @param \App\Market\Items\Comments\CommentRepository $comments
     */
    public function __construct(CommentRepository $comments)
    {
        $this->comments = $comments;
    }

    public function create($listener, $comment)
    {
        $this->comments->delete($comment);

        return $listener->commentDeleted();
    }
}
