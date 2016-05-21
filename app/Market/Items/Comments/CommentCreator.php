<?php

namespace App\Market\Items\Comments;

class CommentCreator
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

    public function create($listener, $data)
    {
        $comment = $this->comments->getNew($data);

        $this->comments->save($comment);

        return $listener->commentCreated();
    }
}
