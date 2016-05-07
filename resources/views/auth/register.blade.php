@extends('layouts.master')

@section('title')
@parent
@stop

@section('content')
<div class="row" style="margin-top: 40px;">
    <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
        <div class="well register-box">
            <div class="login-logo">
                {!! Html::image('/assets/img/pca_logo.png', 'Pinoyc Cubers Association') !!}
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

                {!! Form::open(['url' => 'user/create', 'role' => 'form']) !!}

                    <div class="form-group">
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Lastname']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password', 'required']) !!}
                    </div>

                    {!! Form::submit('Register', ['class' => 'btn btn-md btn-primary', 'id' => 'registerbutton']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop