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
                {!! Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Location']) !!}
            </div>
            <div class="form-group">
                {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
            </div>
            <div class="row form-group">
                <div class="col-md-2">
                    {!! Form::selectMonth('month', Carbon\Carbon::now()->month, ['class' => 'form-control']) !!}
                </div>
                <div class="col-md-2">
                    {!! Form::input('number', 'day', Carbon\Carbon::now()->day, ['class' => 'form-control', 'placeholder' => 'Day', 'maxlength' => '2', 'min' => '1', 'max' => '31']) !!}
                </div>
                <div class="col-md-2">
                    {!! Form::input('number', 'year', Carbon\Carbon::now()->year, ['class' => 'form-control', 'placeholder' => 'Year', 'maxlength' => '4', 'min' => '1980', 'max' => '2050']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::input('time', 'time', '12:00', ['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Set Cube Meet', ['class' => 'btn btn-md btn-primary', 'id' => 'registerbutton']) !!}

        {!! Form::close() !!}
    </div>
</div>

@stop
