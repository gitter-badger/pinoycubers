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
        return $this->belongsTo('App\Accounts\User', 'host');
    }

    public function cubers()
    {
        return $this->hasMany('App\Cubemeets\CMCuber', 'cm_id');
    }
}
