<?php

namespace App\Accounts;

use App\Accounts\Profiles\Profile;
use Hash;

class UserCreator
{
    /**
     * @var \App\Accounts\UserRepository
     */
    protected $users;

    /**
     * @var \App\Accounts\VerificationEmailSender
     */
    protected $verification;

    /**
     * @param \App\Accounts\UserRepository $users
     * @param \App\Accounts\VerificationEmailSender $verification
     */
    public function __construct(UserRepository $users, VerificationEmailSender $verification)
    {
        $this->users = $users;
        $this->verification = $verification;
    }

    public function create($listener, $user_data, $profile_data)
    {
        $user = $this->users->getNew($user_data);

        $user->verification_code = str_random(10);
        $user->verified = false;
        $user->password = Hash::make($user->password);
        $user->role_id = UserRole::$USER;

        $this->users->save($user);

        $this->verification->send($user);

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
