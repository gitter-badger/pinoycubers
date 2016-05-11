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

    public function getById($id)
    {
        return $this->model->with('profile')->where('id', '=', $id)->first();
    }

    public function getByEmail($email)
    {
        return $this->model->with('profile')->where('email', '=', $email)->first();
    }

    public function getAllPaginated($countPerPage)
    {
        return $this->model->with('profile')->paginate($countPerPage);
    }
}
