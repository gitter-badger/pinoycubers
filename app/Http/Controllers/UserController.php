<?php

namespace App\Http\Controllers;

use Auth, View, Input, Redirect, Validator, Hash;
use App\User;
use App\Profile;
use App\UserRole;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getProfile($profile)
    {
        $uname = Profile::where('username',$profile)->count();
        $u_name = Auth::user()->profile->username;

        $photo = empty(Auth::user()->photo) ? "http://placehold.it/230x230" : Auth::user()->photo;

        if($uname)
        {
            // profile found
            if($u_name == $profile)
            {
                // my profile
            }
            else
            {
                // other profile
            }

            return View::make('profile.index',compact("photo"));
        }
        else
        {
            return Redirect::to('/');
        }
    }

    public function register()
    {
        return View::make('user.register');
    }

    public function registerUser()
    {
        // Implement Ardent for validation ??
        // https://github.com/laravelbook/ardent
        // Implement Entrust for user role management ??
        // https://github.com/Zizaco/entrust

        $this->user->email = Input::get('email');
        $username = Input::get('username');
        $this->user->first_name = Input::get('firstname');
        $this->user->last_name = Input::get('lastname');
        $this->user->role_id = UserRole::$USER;

        $password = Input::get('password');

        $input = Input::all();

        $rules = array(
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8'
        );

        $messages = array(
            'email.unique' => 'This email is already used',
            'firstname.required' => 'The first name field is required.',
            'lastname.required' => 'The last name field is required.',
            'username.required' => 'The username field is required.'
        );

        $validation = Validator::make($input, $rules,$messages);

        if($validation->passes())
        {
            // TODO: send email for verification code
            $this->user->verify = str_random(10);
            // for now default is verified
            $this->user->verified = true;
            $this->user->password = Hash::make($password);
            $this->user->save();

            if($this->user->id)
            {
                $profile = new Profile;
                $profile->username = $username;
                $this->user->profile()->save($profile);
                return Redirect::to('/login')->with('success','Account succesfully created');
            }
        }

        return Redirect::to('/register')->withInput()->withErrors($validation);
    }

    public function login()
    {
        return View::make('user.login');
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/')->with('success', "You've been logged out.");
    }

    public function authenticateUser()
    {
        // authenticate user
        $email = Input::get('email');
        $password = Input::get('password');


        if ( isset($email) && isset($password) )
        {

            $credentials = array('email' => $email, 'password' => $password);

            $user = User::where('email',$email)->first();

            if(empty($user))
            {
                return Redirect::to('login')->with('error', 'Invalid email or password');
            }

            if($user->role_id != UserRole::$ADMIN)
            {
                if($user->disabled)
                {
                    return Redirect::to('login')->with('error', 'Your account has been disabled');
                }
                if(!$user->verified)
                {
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

    public function fbLoginCallback()
    {
        $code = Input::get('code');
        if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');

        $facebook = new Facebook(Config::get('app.facebook'));
        $uid = $facebook->getUser();

        if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');

        $me = $facebook->api('/me');

        $profile = Profile::whereUid($uid)->first();
        if (empty($profile))
        {

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

    public function showUsers()
    {
        $users = User::with('profile')->get();

        return View::make('user.list', compact('users'));
    }
}