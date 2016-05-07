<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketItemComments extends Model
{
    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'comment'
    ];

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
        return $this->belongsTo('App\MarketItem', 'item_id');
    }
}
