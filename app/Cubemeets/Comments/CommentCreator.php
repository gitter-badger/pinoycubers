<?php

namespace App\Cubemeets\Comments;

class CommentCreator
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

    public function create($listener, $data)
    {
        $comment = $this->comments->getNew($data);

        $this->comments->save($comment);

        return $listener->commentCreated();
    }
}
