<?php

namespace App\Cubemeets\Attendees;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    /**
     * Fillable fields
     *
     * @var array
     */

    protected $fillable = [
        'cm_id',
        'user_id',
        'status',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    
    protected $table = 'cubemeet_attendees';

    public function cubemeet() {
        return $this->belongsTo('App\Cubemeets\Cubemeet', 'cm_id');
    }

    public function cuberprofile() {
        return $this->belongsTo('App\Accounts\User', 'user_id');
    }

    public function name()
    {
        $profile = $this->getProfile();

        return $profile->first_name.' '.$profile->last_name;
    }

    public function username()
    {
        return $this->getProfile()->username;
    }

    public function getProfile()
    {
        return $this->cuberprofile()->getResults()->profile()->getResults();
    }
}
