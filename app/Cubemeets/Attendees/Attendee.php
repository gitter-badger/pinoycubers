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
        $attendee = $this->cuberprofile()->getResults()->profile()->getResults();

        return $attendee->first_name.' '.$attendee->last_name;
    }
}
