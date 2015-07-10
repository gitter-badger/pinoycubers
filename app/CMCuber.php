<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CMCuber extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cubemeet_cubers';

    public function cubemeet() {
        $this->belongsTo('App\Cubemeet', 'cm_id');
    }
}
