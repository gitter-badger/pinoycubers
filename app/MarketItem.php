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
        'slug'
    ];

    /**
      * Get the users that owns the item.
      */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
