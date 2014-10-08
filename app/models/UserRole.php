<?php

class UserRole extends Eloquent {

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