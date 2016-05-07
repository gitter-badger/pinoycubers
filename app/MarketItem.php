<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketItem extends Model
{
    /**
     * Fillable fields
     *
     * @var array
     */

    protected $fillable = [
        'title',
        'description',
        'contact',
        'price',
        'type',
        'other_type',
        'manufacturer',
        'other_manufacturer',
        'condition',
        'condition_details',
        'container',
        'shipping',
        'shipping_details',
        'meetups',
        'meetup_details',
        'slug',
        'viewers'
    ];

    /**
      * Get the users that owns the item.
      */
    public function user()
    {
        return $this->belongsTo('App\Accounts\User', 'user_id');
    }

    public function comments() {
        return $this->hasMany('App\MarketItemComments', 'item_id');
    }
}
