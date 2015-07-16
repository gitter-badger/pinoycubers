@extends('layouts.master')

@section('title')
@parent
| Cube Meets
@stop

@section('content')

@include('partials.messages')

<div class="row">
    <div class="row">
        <h2>{{ $cm['name'] }} <small>by {{ $cm->host()->getResults()->first_name.' '.$cm->host()->getResults()->last_name }}</small></h2>
    </div>
    <hr>
</div>

<div class="row">
    <div class="row">
        <ul>
            <li><b>Location:</b> {{ $cm->location }}</li>
            <li><b>Date:</b> {{ $cm->date->format('M-d-Y') }}</li>
            <li><b>Start Time:</b> {{ date('h:i A', strtotime($cm->start_time)) }}</li>
            <li><b>Description:</b> {{ $cm->description }}</li>
        </ul>
    </div>

    <div class="row">
        @if ($cm->status == 'Scheduled')
            @if ($cm->host()->getResults()->id == Auth::user()->id)
                {!! Form::open(['method' => 'DELETE', 'route' => ['cubemeets.destroy', $cm->id]]) !!}
                    {!! Html::link('cubemeets/'.$cm->id.'/edit', 'Edit', ['class' => 'btn btn-sm btn-default']) !!}
                    {!! Form::submit('Cancel', ['class' => 'btn btn-sm btn-danger']) !!}
                {!! Form::close() !!}
            @else
                @if (array_first($cm->cubers(), function ($key, $value) {
                    if($value['user_id'] == Auth::user()->id) {
                        if($value['status'] == 'Going') {
                            return true;
                        }
                        return false;
                    }
                    return false;
                }))
                {!! Form::open(['url' => 'cubemeets/'.$cm->id.'/canceljoin', 'role' => 'form']) !!}
                    {!! Form::submit('Not Going', ['class' => 'btn btn-sm btn-primary']) !!}
                    {!! Html::link('cubemeets/'.$cm->id, 'View Details', ['class' => 'btn btn-sm btn-primary']) !!}
                {!! Form::close() !!}
                @else
                {!! Form::open(['url' => 'cubemeets/'.$cm->id.'/join', 'role' => 'form']) !!}
                    {!! Form::submit('Join', ['class' => 'btn btn-sm btn-primary']) !!}
                    {!! Html::link('cubemeets/'.$cm->id, 'View Details', ['class' => 'btn btn-sm btn-primary']) !!}
                {!! Form::close() !!}
                @endif
            @endif
        @endif
    </div>

    <hr>

    <div class="row">
        <h4>List of cuber(s) who will attend</h4>
        <ul>
            <li>{{ $cm->host()->getResults()->first_name.' '.$cm->host()->getResults()->last_name }}</li>
            @if ($cm->cubers()->where('status', 'Going')->count() > 0)
                @foreach ($cm->cubers()->where('status', 'Going')->get() as $cuber)
                <li>{{ $cuber->cuberprofile()->getResults()->first_name.' '.$cuber->cuberprofile()->getResults()->last_name }}</li>
                @endforeach
            @endif
        </ul>

        <h4>List of cuber(s) who canceled their attendance</h4>
            @if ($cm->cubers()->where('status', 'Not Going')->count() > 0)
            <ul>
                @foreach ($cm->cubers()->where('status', 'Not Going')->get() as $cuber)
                <li>{{ $cuber->cuberprofile()->getResults()->first_name.' '.$cuber->cuberprofile()->getResults()->last_name }}</li>
                @endforeach
            </ul>
            @else
                none
            @endif
    </div>
</div>

@stop
