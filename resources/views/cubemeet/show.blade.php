@extends('layouts.master')

@section('title')
@parent
| Cube Meets
@stop

@section('content')

<div class="row">
    <div class="row">
        <h2>{{ $cm['name'] }} <small>by {{ $cm['host']['first_name'].' '.$cm['host']['last_name'] }}</small></h2>
    </div>
    <hr>
</div>

<div class="row">
    <div class="row">
        <ul>
            <li><b>Location:</b> {{ $cm['location'] }}</li>
            <li><b>Date:</b> {{ $cm['date'] }}</li>
            <li><b>Start Time:</b> {{ $cm['start_time'] }}</li>
            <li><b>Description:</b> {{ $cm['description'] }}</li>
        </ul>
    </div>

    <div class="row">
        @if ($cm['status'] == 'Scheduled')
            @if ($cm['host']['id'] == Auth::user()->id)
                {!! Form::open(['method' => 'DELETE', 'route' => ['cubemeets.destroy', $cm['id']]]) !!}
                    {!! Html::link('cubemeets/'.$cm['id'].'/edit', 'Edit', ['class' => 'btn btn-sm btn-default']) !!}
                    {!! Form::submit('Cancel', ['class' => 'btn btn-sm btn-danger']) !!}
                {!! Form::close() !!}
            @else
                {!! Form::open(['url' => 'cubemeets/'.$cm['id'].'/join', 'role' => 'form']) !!}
                    {!! Form::submit('Join', ['class' => 'btn btn-sm btn-primary']) !!}
                {!! Form::close() !!}
            @endif
        @endif
    </div>
</div>

@stop
