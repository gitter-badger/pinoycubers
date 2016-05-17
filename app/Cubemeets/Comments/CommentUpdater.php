<?php

namespace App\Cubemeets\Comments;

class CommentUpdater
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

    public function update($listener, $comment, $data)
    {
        $comment->fill($data);

        $this->comments->save($comment);

        return $listener->commentUpdated($comment);
    }
}
