<?php

namespace App\Cubemeets;

use Auth;
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

    public function comments()
    {
        return $this->hasMany('App\Cubemeets\Comments\Comment', 'cm_id');
    }

    public function hostName()
    {
        $profile = $this->getProfile();

        return $profile->first_name.' '.$profile->last_name;
    }

    public function hostUsername()
    {
        return $this->getProfile()->username;
    }

    public function getProfile()
    {
        return $this->host()->getResults()->profile()->getResults();   
    }

    public function countCubers()
    {
        // + 1 to count the host
        return $this->cubers()->where('status', 'Going')->count() + 1;
    }

    public function signedUserIsHost()
    {
        return $this->host()->getResults()->id == Auth::user()->id;
    }

    public function attendeeIsGoing()
    {
        $status = array_first($this->cubers, function ($key, $value)
        {
            if($value['user_id'] == Auth::user()->id)
            {
                if($value['status'] == 'Going')
                {
                    return true;
                }
            }

            return false;
        });

        return $status;
    }

    public function getAttendees()
    {
        return $this->cubers()->where('status', 'Going')->get();
    }

    public function isManageableBy($user)
    {
        return $user->id == $this->user_id;
    }
}
