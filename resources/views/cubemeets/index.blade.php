@extends('layouts.master')

@section('title')
@parent
| Cube Meets
@stop

@section('content')

<!-- Menu -->
<div class="row">
    <div class="col-md-10" style="margin: 0; padding: 0;">
        <h3>Cube Meets</h3>
    </div>
    <div class="col-md-2 text-right" style="margin-top: 18px; padding: 0">
        <a href="/cubemeets/create/" class="btn btn-sm btn-default">Set Cube Meet</a>
    </div>
</div>

@include('partials.messages')

<!-- Cube Meets -->

{!! $cubemeets->render() !!}

<hr>

@foreach ($cubemeets as $cm)
<div class="row">
    <div class="col-sm-6">
        <ul class="list-unstyled">
            <li>
                <b><a href="{{ '/cubemeets/'.$cm->id }}">{{ $cm->name }}</a></b> 
                <small>by {{ $cm->host()->getResults()->first_name.' '.$cm->host()->getResults()->last_name }}</small>
            </li>
            <li><span class="fa fa-map-marker"></span> {{ $cm->location }}</li>
            <li><span class="fa fa-calendar"></span> {{ $cm->date->format('M d, Y') }}</li>
            <li><span class="fa fa-clock-o"></span> {{ date('h:i A', strtotime($cm->start_time)) }}</li>
        </ul>
    </div>
    <div class="col-sm-5">
        <ul class="list-unstyled">
            <li><span class="fa fa-comment"></span> {{ str_limit($cm->description, 100) }}</li>
            <li><span class="fa fa-user"></span> {{ $cm->cubers()->where('status', 'Going')->count() + 1 }} expected Cuber(s) to attend</li>
        </ul>
    </div>
    <div class="col-sm-1">
        @if ($cm->host()->getResults()->id == Auth::user()->id)
            {!! Form::open(['method' => 'DELETE', 'class' => 'text-right', 'route' => ['cubemeets.destroy', $cm['id']]]) !!}
                <a href="{{ '/cubemeets/'.$cm->id.'/edit' }}" class="btn btn-sm btn-default">Edit</a>
                {!! Form::submit('Cancel', ['class' => 'btn btn-sm btn-danger']) !!}
            {!! Form::close() !!}
        @else
            <div class="text-right">
                @if (array_first($cm->cubers, function ($key, $value) {
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
                {!! Form::close() !!}
                @else
                {!! Form::open(['url' => 'cubemeets/'.$cm->id.'/join', 'role' => 'form']) !!}
                    {!! Form::submit('Join', ['class' => 'btn btn-sm btn-primary']) !!}
                {!! Form::close() !!}
                @endif
            </div>
        @endif
    </div>
</div>
<hr>
@endforeach
        
{!! $cubemeets->render() !!}

<!-- /Cube Meets -->

@stop
