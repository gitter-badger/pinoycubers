<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Profile;
use View;

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
