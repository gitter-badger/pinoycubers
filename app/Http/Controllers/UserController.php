<?php

namespace App\Http\Controllers;

use Auth;
use App\Accounts\Profile;
use App\Accounts\ProfileRepository;
use App\Accounts\ProfileUpdater;
use App\Accounts\ProfileUpdaterListener;
use App\Accounts\User;
use App\Accounts\UserRole;
use App\Accounts\UserRepository;
use App\Accounts\UserUpdater;
use App\Accounts\UserUpdaterListener;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use Hash;
use Input;
use Redirect;
use Validator;
use View;

class UserController extends Controller implements ProfileUpdaterListener, UserUpdaterListener
{
    /**
     * @var \App\Accounts\User
     */
    protected $user;

    /**
     * @var \App\Accounts\UserRepository
     */
    protected $users;

    /**
     * @var \App\Accounts\ProfileRepository
     */
    protected $profiles;

    /**
     * @var \App\Accounts\ProfileUpdater
     */
    protected $profileUpdater;

    /**
     * @var \App\Accounts\UserUpdater
     */
    protected $userUpdater;

    protected $usersPerPage = 30;

    /**
     * @param \App\Accounts\User $user
     * @param \App\Accounts\UserRepository $users
     * @param \App\Accounts\ProfileRepository $profiles
     * @param \App\Accounts\ProfileUpdater $profileUpdater
     * @param \App\Accounts\UserUpdater $userUpdater
     * @return void
     */
    public function __construct(User $user, UserRepository $users, ProfileRepository $profiles, ProfileUpdater $profileUpdater, UserUpdater $userUpdater)
    {
        $this->user = $user;
        $this->users = $users;
        $this->profiles = $profiles;
        $this->profileUpdater = $profileUpdater;
        $this->userUpdater = $userUpdater;
    }

    public function showUser($username)
    {
        $profile = $this->profiles->getByUsername($username);

        $user = $this->users->getById($profile->user_id);

        return View::make('profile.index', compact('user'));
    }

    public function showUsers()
    {
        $users = $this->users->getAllPaginated($this->usersPerPage);

        return View::make('user.list', compact('users'));
    }

    public function getEditProfile()
    {
        return View::make('profile.edit');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $profile = $this->profiles->getByUserId($request->user()->id);

        $data = $request->all();

        return $this->profileUpdater->update($this, $profile, $data);
    }

    public function updateUser(UpdateUserRequest $request)
    {
        $user = $this->users->getById($request->user()->id);

        $data = $request->all();

        return $this->userUpdater->update($this, $user, $data);
    }

    public function profileUpdated()
    {
        return Redirect::to('/edit/profile')->with('success', 'Profile successfully updated');
    }

    public function userUpdated()
    {
        return Redirect::to('/edit/profile')->with('success', 'User successfully updated');
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
}
