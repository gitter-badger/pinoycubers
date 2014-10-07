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

    // TODO:: Implement Login
    public function login(){
        return View::make('user.login');
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('/')->with('success', "You've been logged out.");
    }

    public function fbLogin()
    {
        $facebook = new Facebook(Config::get('app.facebook'));
        $params = array(
            'redirect_uri' => url('/login/fb/callback'),
            'scope' => 'email',
        );
        return Redirect::to($facebook->getLoginUrl($params));
    }

    public function fbLoginCallback(){
        $code = Input::get('code');
        if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');

        $facebook = new Facebook(Config::get('app.facebook'));
        $uid = $facebook->getUser();

        if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');

        $me = $facebook->api('/me');

        $profile = Profile::whereUid($uid)->first();
        if (empty($profile)) {

            $user = new User;
            $user->name = $me['first_name'].' '.$me['last_name'];
            $user->email = $me['email'];
            $user->photo = 'https://graph.facebook.com/'.$me['username'].'/picture?type=large';

            $user->save();

            $profile = new Profile();
            $profile->uid = $uid;
            $profile->username = $me['username'];
            $profile = $user->profile()->save($profile);
        }

        $profile->access_token = $facebook->getAccessToken();
        $profile->save();

        $user = $profile->user;

        Auth::login($user);

        return Redirect::to("/".$profile->username)->with('message', 'Logged in with Facebook');
    }
}