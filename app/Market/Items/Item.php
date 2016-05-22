<?php

namespace App\Market\Items;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
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
     * The table used by the model
     */
    protected $table = 'market_items';

    /**
      * Get the users that owns the item.
      */
    public function user()
    {
        return $this->belongsTo('App\Accounts\User', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Market\Items\Comments\Comment', 'item_id');
    }

    public function ownerName()
    {
        return $this->user->profile->first_name.' '.$this->user->profile->last_name;
    }

    public function isManageableBy($user)
    {
        return $this->user_id == $user->id;
    }
}
