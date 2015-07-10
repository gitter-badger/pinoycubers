@extends('layouts.master')

@section('title')
@parent
| Edit Cube Meets
@stop

@section('content')

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
            <div class="form-group">
                {!! Form::input('date', 'date', Carbon\Carbon::now()->toDateString(), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::input('time', 'time', Carbon\Carbon::now()->toTimeString(), ['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Save', ['class' => 'btn btn-md btn-primary', 'id' => 'savebutton']) !!}

        {!! Form::close() !!}
    </div>
</div>

@stop
