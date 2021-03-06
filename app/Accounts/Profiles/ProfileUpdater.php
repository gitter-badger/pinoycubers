<?php

namespace App\Accounts\Profiles;

class ProfileUpdater
{
    /**
     * @var \App\Accounts\ProfileRepository
     */
    protected $profiles;

    /**
     * @param \App\Accounts\ProfileRepository $profiles
     */
    public function __construct(ProfileRepository $profiles)
    {
        $this->profiles = $profiles;
    }

    public function update($listener, $profile, $data)
    {
        $profile->fill($data);

        $this->profiles->save($profile);

        return $listener->profileUpdated();
    }
}
