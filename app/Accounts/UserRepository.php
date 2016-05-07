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
}
