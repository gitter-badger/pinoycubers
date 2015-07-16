@extends('layouts.master')

@section('title')
@parent
| Edit Cube Meets
@stop

@section('content')

@if ($errors->any())
<!-- Error Message -->
<div class="row">
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<div class="row">
    <div class="well">
        <h4>Edit Cube Meet</h4>

        <hr>

        {!! Form::model($cubemeet, ['route' => ['cubemeets.update', $cubemeet->id], 'method' => 'patch', 'role' => 'form']) !!}

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
                {!! Form::input('time', 'time', date('H:i', strtotime($cubemeet->start_time)), ['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Save', ['class' => 'btn btn-md btn-primary', 'id' => 'savebutton']) !!}

        {!! Form::close() !!}
    </div>
</div>

@stop
