<?php

class UserController extends BaseController{
    public function getProfile($profile){
        $uname  = Profile::where('username',$profile)->count();
        $u_name = Auth::user()->profile->name;

        $photo = empty(Auth::user()->photo) ? "http://placehold.it/230x230" : Auth::user()->photo;

        if($uname){
            // profile found
            if($u_name == $profile){
                // my profile
            } else {
                // other profile
            }
            return View::make('profile.index',compact("photo"));
        } else {
            return Redirect::to('/');
        }
    }

    public function login(){
        return View::make('user.login');
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('/')->with('success', "You've been logged out.");
    }

    public function authenticateUser()
    {
        // authenticate user
        $email = Input::get('email');
        $password = Input::get('password');


        if ( isset($email) && isset($password) ) {

            $credentials = array('email' => $email, 'password' => $password);

            $user = User::where('email',$email)->first();

            if(empty($user)){
                return Redirect::to('login')->with('error', 'Invalid email or password');
            }

            if($user->role_id != UserRole::$ADMIN){
                if($user->disabled){
                    return Redirect::to('login')->with('error', 'Your account has been disabled');
                }
                if(!$user->verified) {
                    return Redirect::to('login')->with('error', 'Your account has not been verified yet');
                }
            }


            if (Auth::attempt($credentials))
            {

                return Redirect::intended('/');
            }
            else
            {
                return Redirect::to('login')->with('error', 'Invalid email or password');
                // pass any error notification you want
            }
        }
        return Redirect::to('login');
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