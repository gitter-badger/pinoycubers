@extends('layouts.master')

@section('title')
@parent
| Cube Meets
@stop

@section('content')

<div class="row">
    <div class="row">
        <h2>{{ $cm->name }} <small>by {{ $cm->host }}</small></h2>
    </div>
    <hr>
</div>

<div class="row">
    <div class="row">
        <ul>
            <li><b>Location:</b> {{ $cm->location }}</li>
            <li><b>Date:</b> {{ $cm->date }}</li>
            <li><b>Start Time:</b> {{ $cm['start_time'] }}</li>
        </ul>
    </div>

    <div class="row">
        {!! Html::link('#', 'Join', ['class' => 'btn btn-sm btn-primary']) !!}
    </div>
</div>

@stop
