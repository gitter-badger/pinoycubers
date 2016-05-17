@extends('layouts.master')

@section('title')
@parent
| Set Cube Meets
@stop

@section('content')

@include('partials.messages')

<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="well">
            <h4><a href="{{ '/cubemeets/'.$cubemeet->slug }}">{{ $cubemeet->name }}</a></h4>
            <h5>{{ $cubemeet->location }}</h5>

            <hr>

            <p>Are you sure you want to cancel <b>{{ $cubemeet->name }}</b>?</p>

            {!! Form::open(['url' => 'cubemeets/'.$cubemeet->slug.'/cancel', 'role' => 'form']) !!}

                <div class="form-group">
                    <label for="reason">Tell us your reason:</label>
                    {!! Form::textarea('reason', null, ['id' => 'reason', 'class' => 'form-control', 'placeholder' => 'Tell us your reason.', 'required']) !!}
                </div>

                {!! Form::submit('Submit', ['class' => 'btn btn-md btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
</div>

@stop
