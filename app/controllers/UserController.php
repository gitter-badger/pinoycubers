<?php

class UserController extends BaseController{
    public function getProfile($profile){
        $uname  = Profile::where('username',$profile)->count();
        $u_name = Auth::user()->profile->name;

        if($uname){
            // profile found
            if($uname == $profile){
                // my profile
            } else {
                // other profile
            }
            return View::make('profile.index');
        } else {
            return Redirect::to('/');
        }
    }
}