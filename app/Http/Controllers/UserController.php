<?php

namespace App\Http\Controllers;

use Auth, View, Input, Redirect, Validator, Hash;
use App\Accounts\User;
use App\Accounts\Profile;
use App\Accounts\UserRole;

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
                $user = Auth::user();
                return View::make('profile.index', compact('user'));
            }

            // other profile
            $user_profile = Profile::where('username', $profile)->first();
            $user = User::with('profile')->where('id', $user_profile->user_id)->first();

            return View::make('profile.index',compact("user"));
        }
        else
        {
            return Redirect::to('/');
        }
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

    public function getEditProfile()
    {
        return View::make('profile.edit');
    }

    public function postEditProfile()
    {
        $user = $this->user->where('id', Auth::user()->id)->first();

        if(!$user)
        {
            return Redirect::to('/edit/profile');
        }

        $inputs = Input::all();
        $rules = array();
        $messages = array();
        $updatedinfo = array();
        $successmsg = '';

        if($inputs['action'] == 'Update Profile')
        {
            $updatedinfo = array(
                'first_name' => $inputs['firstname'],
                'last_name' => $inputs['lastname'],
                'email' => $inputs['email']
            );

            $rules = array(
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email|unique:users,email,'.$user->id
            );

            $messages = array(
                'firstname.required' => 'The first name field is required.',
                'lastname.required' => 'The last name field is required.',
                'email.unique' => 'This email is already used'
            );

            $successmsg = 'Profile successfully updated';
        }
        else if($inputs['action'] == 'Update Password')
        {
            if(Hash::check($inputs['currentpass'], $user->password)) {
                $inputs['currentpass'] = Hash::make($inputs['currentpass']);

                $updatedinfo = array(
                    'password' => Hash::make($inputs['newpass'])
                );

                $rules = array(
                    'currentpass' => 'required',
                    'newpass' => 'required|confirmed|min:8'
                );

                $messages = array(
                    'currentpass.required' => 'The current password is required',
                    'newpass.required' => 'The new password is required',
                    'newpass.confirmed' => 'Password confirmation does not match'
                );

                $successmsg = 'Password successfully updated';
            }
            else {
                return Redirect::to('/edit/profile')->with('error', 'The current password is incorrect');
            }
        }

        $validation = Validator::make($inputs, $rules, $messages);

        if($validation->passes())
        {
            $user->fill($updatedinfo)->save();

            return Redirect::to('/edit/profile')->with('success', $successmsg);
        }

        return Redirect::to('/edit/profile')->withInput()->withErrors($validation);
    }
}