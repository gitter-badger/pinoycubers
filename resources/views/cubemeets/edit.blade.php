@extends('layouts.master')

@section('title')
@parent
| Edit Cube Meets
@stop

@section('content')

@include('partials.messages')

<div class="row">
    <div class="well">
        <h4>Edit Cube Meet</h4>

        <hr>

        {!! Form::model($cubemeet, ['url' => '/cubemeets/'.$cubemeet->slug.'/edit', 'method' => 'POST', 'role' => 'form']) !!}

            @include('partials.fields')

            <div class="row form-group">
                <div class="col-md-2">
                    {!! Form::selectMonth('month', $cubemeet->date->format('m'), ['class' => 'form-control']) !!}
                </div>
                <div class="col-md-2">
                    {!! Form::input('number', 'day', $cubemeet->date->format('d'), ['class' => 'form-control', 'placeholder' => 'Day', 'maxlength' => '2', 'min' => '1', 'max' => '31']) !!}
                </div>
                <div class="col-md-2">
                    {!! Form::input('number', 'year', $cubemeet->date->format('Y'), ['class' => 'form-control', 'placeholder' => 'Year', 'maxlength' => '4', 'min' => '1980', 'max' => '2050']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::input('time', 'time', date('H:i', strtotime($cubemeet->start_time)), ['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Save', ['class' => 'btn btn-md btn-primary', 'id' => 'savebutton']) !!}

        {!! Form::close() !!}
    </div>
</div>

@stop
