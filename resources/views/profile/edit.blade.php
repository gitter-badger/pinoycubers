@extends('layouts.master')

@section('title')
@parent
| Edit Profile
@stop

@section('content')

@include('partials.messages')

<div class="row">
    <div class="well">
        <h4>Update Profile Information</h4>

        <hr>
        <h5>Avatar</h5>

        <div class="row">
            <div class="col-sm-3">
                <img class="img img-rounded" src="{{ Auth::user()->photo? Auth::user()->photo: 'https://placehold.it/200x200?text=No Avatar' }}">
            </div>
            <div class="col-sm-9">
                {!! Form::open(['url' => '/update/avatar', 'role' => 'form', 'class' => 'form-horizontal', 'files' => true]) !!}
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="avatar">Choose an image</label>
                        <div class="col-sm-10">
                            <input type="file" name="avatar" id="avatar" class="form-control" accept="image/x-png,image/jpeg" required>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-md btn-primary" value="Update Avatar">
                </form>
            </div>
        </div>

        <hr>
        <h5>Personal Information</h5>

        {!! Form::open(['url' => '/update/profile', 'role' => 'form', 'class' => 'form-horizontal']) !!}

            <div class="form-group">
                <label class="control-label col-sm-2" for="username">Username</label>
                <div class="col-sm-10">
                    <input type="text" id="username" class="form-control" name="username" placeholder="Username" value="{{ Auth::user()->profile->username }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="firstname">First Name</label>
                <div class="col-sm-10">
                    <input type="text" id="firstname" class="form-control" name="first_name" placeholder="First Name" value="{{ Auth::user()->profile->first_name }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="lastname">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" id="lastname" class="form-control" name="last_name" placeholder="Last Name" value="{{ Auth::user()->profile->last_name }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="location">Location</label>
                <div class="col-sm-10">
                    <input type="text" id="location" class="form-control" name="location" placeholder="Location" value="{{ Auth::user()->profile->location }}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="wca_id">WCA ID</label>
                <div class="col-sm-10">
                    <input type="text" id="wca_id" class="form-control" name="wca_id" placeholder="WCA ID" value="{{ Auth::user()->profile->wca_id }}">
                </div>
            </div>

            <input type="submit" id="registerbutton" class="btn btn-md btn-primary" name="action" value="Update Profile">

        </form>

        <hr>
        <h5>Account Information</h5>

        {!! Form::open(['url' => '/update/email', 'role' => 'form', 'class' => 'form-horizontal']) !!}

            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email</label>
                <div class="col-sm-10">
                    <input type="text" id="email" class="form-control" name="email" placeholder="Email" value="{{ Auth::user()->email }}" required>
                </div>
            </div>

            <input type="submit" id="registerbutton" class="btn btn-md btn-primary" name="action" value="Update Email">

        </form>

        {!! Form::open(['url' => '/update/password', 'role' => 'form', 'class' => 'form-horizontal']) !!}

            <div class="form-group">
                <label class="control-label col-sm-2" for="currentpass">Current Password</label>
                <div class="col-sm-10">
                    <input type="password" id="currentpass" class="form-control" name="currentpass" placeholder="Current Password" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="newpass">New Password</label>
                <div class="col-sm-10">
                    <input type="password" id="newpass" class="form-control" name="newpass" placeholder="New Password" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="newpass_confirmation">New Password Confirmation</label>
                <div class="col-sm-10">
                    <input type="password" id="newpass_confirmation" class="form-control" name="newpass_confirmation" placeholder="Repeat New Password" required>
                </div>
            </div>

            <input type="submit" id="registerbutton" class="btn btn-md btn-primary" name="action" value="Update Password">

        </form>
    </div>
</div>

@stop
