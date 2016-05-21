<?php

namespace App\Market\Items\Comments;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = ['comment'];

    /**
     * The table used by the model
     */
    protected $table = 'market_item_comments';

    /**
      * Get the users that owns the comment.
      */
    public function user()
    {
        return $this->belongsTo('App\Accounts\User', 'user_id');
    }

    /**
      * Get the item that owns the comment.
      */
    public function item()
    {
        return $this->belongsTo('App\Market\Items\Item', 'item_id');
    }
}
