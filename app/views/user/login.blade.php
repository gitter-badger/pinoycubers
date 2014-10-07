@extends('layouts.master')

@section('title')
@stop

@section('content')
<div class="row" style="margin-top: 40px;">
    <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
        <div class="well login-box">
            <div class="login-logo">
                {{ HTML::image('assets/img/pca_logo.png','Pinoy Cubers Association', array('height' => '50px')) }}
            </div>
            <hr />
            <div class="login-form">
                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
                <form action="/user/authenticate" method="POST" role="form">
                    <div class="form-group">
                        <input
                            type="email" name="email" placeholder="Email" id="email" value="" class="form-control"
                            />
                    </div>
                    <div class="form-group">
                        <input
                            type="password" name="password" id="password" placeholder="Password" class="form-control"
                            />
                    </div>
                    <input type="submit" id="loginbutton" class="btn bdn-md btn-primary" value="Login"
                        />
                </form>
                    <span class="help-block">
                    	<a href="/password/forgot">Forgot your password?</a>
                    </span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
        <div class="well">
            <a class="btn bdn-md btn-warning" href="/register">
                Create an account
            </a>
        </div>
    </div>
</div>
@stop