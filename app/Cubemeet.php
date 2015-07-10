<?php

namespace App;

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

    public function host()
    {
        return $this->belongsTo('App\User', 'host');
    }

    public function cubers()
    {
        return $this->hasMany('App\CMCuber', 'cm_id');
    }
}
