<?php

class HomeController extends BaseController {

	public function showIndex()
	{;

        if (Auth::check()) {
            $username = Auth::user()->profile->username;
            return Redirect::to("/$username");
        }

        return View::make('index');

	}

}