<?php

namespace App\Accounts;

interface UserUpdaterListener
{
    public function emailUpdated();
    public function passwordUpdated();
    public function avatarUpdated();
    public function userVerified();
}
