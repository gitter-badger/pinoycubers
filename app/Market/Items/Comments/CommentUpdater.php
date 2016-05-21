<?php

namespace App\Market\Items\Comments;

class CommentUpdater
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

    public function update($listener, $comment, $data)
    {
        $comment->fill($data);

        $this->comments->save($comment);

        return $listener->commentUpdated();
    }
}
