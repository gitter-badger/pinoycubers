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
        <h5>Personal Information</h5>

        {!! Form::open(['url' => '/update/profile', 'role' => 'form', 'class' => 'form-horizontal']) !!}

            <div class="form-group">
                <label class="control-label col-sm-2" for="firstname">First Name</label>
                <div class="col-sm-10">
                    <input type="text" id="firstname" class="form-control" name="firstname" placeholder="First Name" value="{{ Auth::user()->profile->first_name }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="lastname">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Last Name" value="{{ Auth::user()->profile->last_name }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="location">Location</label>
                <div class="col-sm-10">
                    <input type="text" id="location" class="form-control" name="location" placeholder="Location" value="{{ Auth::user()->profile->location }}" required>
                </div>
            </div>

            <input type="submit" id="registerbutton" class="btn btn-md btn-primary" name="action" value="Update Profile">

        </form>

        <hr>
        <h5>Account Information</h5>

        {!! Form::open(['url' => '/update/user', 'role' => 'form', 'class' => 'form-horizontal']) !!}

            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email</label>
                <div class="col-sm-10">
                    <input type="text" id="email" class="form-control" name="email" placeholder="Email" value="{{ Auth::user()->email }}" required>
                </div>
            </div>
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

            <input type="submit" id="registerbutton" class="btn btn-md btn-primary" name="action" value="Update Account">

        </form>
    </div>
</div>

@stop
