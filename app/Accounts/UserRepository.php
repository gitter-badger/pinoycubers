<?php

namespace App\Accounts;

use App\Repository;

class UserRepository extends Repository
{
    /**
     * @var \App\Accounts\User
     */
    protected $model;

    /**
     * @param \App\Accounts\User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getUserByUsername($username)
    {
        return $this->model->with('profile')->where('username', '=', $username)->first();
    }
}
