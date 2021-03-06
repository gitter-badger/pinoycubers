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
use App\Accounts\UserRepository;
use App\Accounts\UserUpdater;
use App\Accounts\UserUpdaterListener;
use App\Accounts\VerificationEmailSender;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\Request;

class AuthController extends Controller implements UserCreatorListener, UserUpdaterListener
{
    /**
     * @var \App\Accounts\UserRepository
     */
    protected $users;

    /**
     * @var \App\Accounts\UserCreator
     */
    protected $userCreator;

    /**
     * @var \App\Accounts\UserUpdater
     */
    protected $userUpdater;

    /**
     * @var \App\Accounts\VerificationEmailSender
     */
    protected $verification;

    /**
     * @param \App\Accounts\UserRepository $users
     * @param \App\Accounts\UserCreator $userCreator
     * @param \App\Accounts\UserUpdater $userUpdater
     * @param \App\Accounts\VerificationEmailSender $verification
     * @return void
     */
    public function __construct(UserRepository $users, UserCreator $userCreator, UserUpdater $userUpdater, VerificationEmailSender $verification)
    {
        $this->users = $users;
        $this->userCreator = $userCreator;
        $this->userUpdater = $userUpdater;
        $this->verification = $verification;

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

        $user = $this->users->getByEmail($email);

        if($user->verified)
        {
            if(Auth::attempt(['email' => $email, 'password' => $password]))
            {
                return Redirect::intended('/');
            }

            return Redirect::to('login')->with('error', 'Invalid email or password');
        }

        return $this->unverifiedUser();
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

    public function verifyUser($code)
    {
        $user = $this->users->getByVerificationCode($code);

        if($user)
        {
            return $this->userUpdater->verify($this, $user);
        }

        return $this->invalidVerificationCode();
    }

    public function resendVerification()
    {
        return View::make('auth.resend_verification');
    }

    public function resend(Request $request)
    {
        $user = $this->users->getByEmail($request->get('email'));

        if($user->verified === 0)
        {
            $this->verification->send($user);
        }

        return $this->verificationSent();
    }

    public function userCreated()
    {
        $message = 'Registration successful. Please check the verification email that was sent to the email you registered.';

        return Redirect::to('/login')->with('success', $message);
    }

    public function unverifiedUser()
    {
        $message = 'Your account was not yet verified. Please check the verification email that was sent to the email you registered. Didn\'t receive an email? <a href="/resend/verification">Click here</a> to resend.';

        return Redirect::to('/login')->with('error', $message);
    }

    public function invalidVerificationCode()
    {
        return Redirect::to('/login')->with('error', 'Invalid verification code.');
    }

    public function userVerified()
    {
        return Redirect::to('/login')->with('success', 'Verification successful. You can now login your account.');
    }

    public function verificationSent()
    {
        return Redirect::to('/login')->with('success', 'The verification email has been sent. Kindly check your inbox.');
    }

    public function emailUpdated() {}
    public function passwordUpdated() {}
    public function avatarUpdated() {}

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/')->with('success', "You've been logged out.");
    }
}
