@extends('layouts.master')

@section('title')
@parent
| Set Cube Meets
@stop

@section('content')

<div class="row">
    <div class="well">
        <h4>Set Cube Meet</h4>

        <hr>

        {!! Form::open(['url' => 'cubemeets', 'role' => 'form']) !!}

            <div class="form-group">
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'CM Name']) !!}
            </div>
            <div class="form-group">
                {!! Form::text('host', null, ['class' => 'form-control', 'placeholder' => 'Host']) !!}
            </div>
            <div class="form-group">
                {!! Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Location']) !!}
            </div>
            <div class="form-group">
                {!! Form::textarea('desecription', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
            </div>
            <div class="form-group">
                {!! Form::input('date', 'date', Carbon\Carbon::now()->toDateString(), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::input('time', 'time', Carbon\Carbon::now()->toTimeString(), ['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Register', ['class' => 'btn btn-md btn-primary', 'id' => 'registerbutton']) !!}

        {!! Form::close() !!}
    </div>
</div>

@stop
