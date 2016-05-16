<?php

namespace App\Cubemeets;

use Illuminate\Database\Eloquent\Model;

class Cubemeet extends Model
{
    /**
     * Fillable fields
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'user_id',
        'location',
        'description',
        'date',
        'start_time',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $dates = ['date'];

    public function host()
    {
        return $this->belongsTo('App\Accounts\User', 'user_id');
    }

    public function cubers()
    {
        return $this->hasMany('App\Cubemeets\Attendees\Attendee', 'cm_id');
    }

    public function hostName()
    {
        $profile = $this->host()->getResults()->profile()->getResults();

        return $profile->first_name.' '.$profile->last_name;
    }
}
