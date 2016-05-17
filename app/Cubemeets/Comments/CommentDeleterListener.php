<?php

namespace App\Cubemeets\Comments;

interface CommentDeleterListener
{
    public function commentDeleted($fromCubemeet);
}
