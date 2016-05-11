<?php

namespace App\Accounts;

class Userpdater
{
    /**
     * @var \App\Accounts\UserRepository
     */
    protected $users;

    /**
     * @param \App\Accounts\UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function update($listener, $user, $data)
    {
        $user->fill($data);

        $this->users->save($user);

        return $listener->userUpdated();
    }
}
