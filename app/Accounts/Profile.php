<?php

namespace App\Accounts;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'location'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
