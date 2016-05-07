<?php

namespace App\Accounts;

use Hash;

class UserCreator
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

    public function create($listener, $user_data, $profile_data)
    {
        $user = $this->users->getNew($user_data);

        // TODO: send email for verification code
        $user->verify = str_random(10);

        // for now default is verified
        $user->verified = true;

        $user->password = Hash::make($user->password);
        $user->role_id = UserRole::$USER;

        $this->users->save($user);

        return $this->createProfile($listener, $user, $profile_data);
    }

    public function createProfile($listener, $user, $profile_data)
    {
        // Create a new user profile
        $profile = new Profile($profile_data);

        $user->profile()->save($profile);

        return $listener->userCreated();
    }
}
