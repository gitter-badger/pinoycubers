<?php

namespace App\Accounts;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public $timestamps = false;

    public static $ADMIN = 1;
    public static $USER = 2;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_roles';
}
