<?php

namespace App\Http\Controllers\Auth;

use Auth;
use View;
use Input;
use Redirect;
use Validator;
use App\Accounts\User;
use App\Accounts\UserRole;
use App\Accounts\UserCreator;
use App\Accounts\UserCreatorListener;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;

class AuthController extends Controller
{
    /**
     * @var \App\Accounts\UserCreator
     */
    protected $userCreator;

    /**
     * Create a new authentication controller instance.
     *
     * @param \App\Accounts\UserCreator $userCreator
     * @return void
     */
    public function __construct(UserCreator $userCreator)
    {
        $this->userCreator = $userCreator;

        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login()
    {
        return View::make('auth.login');
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
        return View::make('auth.register');
    }

    public function create(RegistrationRequest $request)
    {
        $user_data = $request->only(['email', 'password']);
        $profile_data = $request->only(['username', 'first_name', 'last_name']);
        
        return $this->userCreator->create($this, $user_data, $profile_data);
    }

    public function userCreated()
    {
        $message = 'Registration successful. Please check the verification email that was sent to the email you registered.';

        return Redirect::to('/login')->with('success', $message);
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/')->with('success', "You've been logged out.");
    }
}
