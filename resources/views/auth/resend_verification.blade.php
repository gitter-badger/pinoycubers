@extends('layouts.master')

@section('title')
@parent
@stop

@section('content')
<div class="row" style="margin-top: 40px;">
    <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
        <div class="well login-box">
            <div class="login-logo">
                <img src="/assets/img/pca_logo.png" alt="Pinoy Cubers Association">
            </div>
            <hr />
            <div class="login-form">
                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

                @if(Session::has('error'))
                <div class="alert alert-danger">{!! Session::get('error') !!}</div>
                @endif

                {!! Form::open(['url' => '/resend/verification', 'role' => 'form']) !!}

                    <div class="form-group">
                        {!! Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                    </div>
                
                    {!! Form::submit('Resend Verification', ['class' => 'btn btn-md btn-primary']) !!}
                
                {!! Form::close() !!}
                    
                    <span class="help-block">
                        <a href="/login">Click here to login.</a>
                    </span>
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
            <a class="btn btn-md btn-warning" href="/register">
                Create an account
            </a>
        </div>
    </div>
</div>
@stop
