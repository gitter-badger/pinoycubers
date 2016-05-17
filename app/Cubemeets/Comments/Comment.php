<?php

namespace App\Cubemeets\Comments;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = ['user_id', 'cm_id', 'comment'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cubemeet_comments';

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

    public function getAuthorName()
    {
        $profile = $this->user()->getResults()->profile()->getResults();

        return $profile->first_name.' '.$profile->last_name;
    }
}
