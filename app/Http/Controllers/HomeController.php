<?php

namespace App\Http\Controllers;

use Auth, View, Redirect;
use App\User;
use App\Profile;

class HomeController extends Controller
{
	public function showIndex()
	{
        if (Auth::check())
        {
            $username = Auth::user()->profile->username;
            return Redirect::to("/$username");
        }

        return View::make('index');
	}

    public function showCubemeets()
    {
        return View::make('cubemeet.index');
    }

}
