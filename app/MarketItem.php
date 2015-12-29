<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketItem extends Model
{
    /**
      * Get the users that owns the item.
      */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
