<?php

namespace App\Cubemeets\Comments;

use App\Repository;

class CommentRepository extends Repository
{
    /**
     * @var \App\Cubemeets\Comments\Comment
     */
    protected $model;

    /**
     * @param \App\Cubemeets\Comments\Comment $model
     */
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }
}
