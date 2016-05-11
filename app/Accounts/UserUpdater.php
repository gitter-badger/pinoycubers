<?php

namespace App\Accounts;

class UserUpdater
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

    public function updateEmail($listener, $user, $data)
    {
        // TODO: send email verification code if the email was changed

        $this->update($user, $data);

        return $listener->emailUpdated();
    }

    public function updatePassword($listener, $user, $data)
    {
        $this->update($user, $data);

        return $listener->passwordUpdated();
    }

    private function update($user, $data)
    {
        $user->fill($data);

        return $this->users->save($user);
    }

    public function verify($listener, $user)
    {
        $user->verified = true;

        $this->users->save($user);

        return $listener->userVerified();
    }
}
