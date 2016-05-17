<?php

namespace App\Cubemeets\Comments;

use Illuminate\Database\Eloquent\Model;

class CubemeetComment extends Model
{
    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = ['comment'];

    /**
     * Get the users that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\Accounts\User', 'user_id');
    }

    /**
     * Get the cubemeet that owns the comment.
     */
    public function cubemeet()
    {
        return $this->belongsTo('App\Cubemeets\Cubemeet', 'cm_id');
    }
}
