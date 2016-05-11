<?php

namespace App\Accounts;

use App\Repository;

class ProfileRepository extends Repository
{
    /**
     * @var \App\Accounts\Profile
     */
    protected $model;

    /**
     * @param \App\Accounts\Profile $model
     */
    public function __construct(Profile $model)
    {
        $this->model = $model;
    }

    public function getByUserId($id)
    {
        return $this->model->where('user_id', '=', $id)->first();
    }

    public function getByUsername($username)
    {
        return $this->model->where('username', '=', $username)->first();
    }
}
