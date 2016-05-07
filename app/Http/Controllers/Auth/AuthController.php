<?php

namespace App\Http\Controllers\Auth;

use Auth;
use View;
use Input;
use Redirect;
use Validator;
use App\Accounts\User;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function login()
    {
        return View::make('user.login');
    }

    public function authenticate()
    {
        $email = Input::get('email');
        $password = Input::get('password');

        if(Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return Redirect::intended('/');
        }

        return Redirect::to('login')->with('error', 'Invalid email or password');
    }

    public function register()
    {
        return View::make('user.register');
    }

    public function create()
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

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/')->with('success', "You've been logged out.");
    }
}
