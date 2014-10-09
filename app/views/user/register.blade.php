@extends('layouts.master')

@section('title')
@parent
@stop

@section('content')
<div class="row" style="margin-top: 40px;">
    <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
        <div class="well register-box">
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
                @if($errors->any())
                <div class="validation-summary-errors alert alert-danger">
                    <ul>
                        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                    </ul>
                </div>
                @endif
                <form action="/user/create" method="POST" role="form">
                    <div class="form-group">
                        {{ Form::email('email',null,array('placeholder'=> 'Email','id' => 'email','class'=>'form-control','required'=>'')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::text('username',null,array('placeholder'=> 'Username','id' => 'username','class'=>'form-control','required'=>'')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::text('firstname',null,array('placeholder'=> 'First Name','id' => 'firstname','class'=>'form-control','required'=>'')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::text('lastname',null,array('placeholder'=> 'Last Name','id' => 'lastname','class'=>'form-control','required'=>'')) }}
                    </div>
                    <div class="form-group">
                        <input
                            type="password" name="password" id="password" placeholder="Password" class="form-control" required
                            />
                    </div>
                    <div class="form-group">
                        <input
                            type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" class="form-control" required
                            />
                    </div>
                    <input type="submit" id="registerbutton" class="btn btn-md btn-primary" value="Register"
                        />
                </form>
            </div>
        </div>
    </div>
</div>
@stop