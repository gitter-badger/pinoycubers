<?php

namespace App\Market\Items\Comments;

use App\Repository;

class CommentRepository extends Repository
{
    /**
     * @var \App\Market\Items\Comments\Comment
     */
    protected $model;

    /**
     * @param \App\Market\Items\Comments\Comment $model
     */
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    public function getFromItemPaginated($item, $perPage = 10)
    {
        return $item->comments()->paginate($perPage);
    }
}
