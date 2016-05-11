<?php

namespace App\Accounts;

interface UserUpdaterListener
{
    public function emailUpdated();
    public function passwordUpdated();
    public function userVerified();
}
