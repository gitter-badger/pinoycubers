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
}
