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
        </ul>
    </div>

    <div class="row">
        @if ($cm['host']['id'] == Auth::user()->id)
            {!! Html::link('cubemeets/'.$cm['id'].'/edit', 'Edit', ['class' => 'btn btn-sm btn-default']) !!}
            {!! Html::link('#', 'Cancel', ['class' => 'btn btn-sm btn-danger']) !!}
        @else
            {!! Html::link('#', 'Join', ['class' => 'btn btn-sm btn-primary']) !!}
        @endif
    </div>
</div>

@stop
