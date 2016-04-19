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
            return View::make('home');
        }

        return View::make('index');
	}
}
