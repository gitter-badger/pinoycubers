@extends('layouts.master')

@section('title')
@parent
| Cube Meets
@stop

@section('content')

@include('partials.messages')

<div class="row">
    <h2>{{ $cm->name }} <small>by <a href="{{ '/'.$cm->hostUsername() }}">{{ $cm->hostName() }}</a></small></h2>
</div>

<div class="row">
    <div class="col-sm-6">
        <ul class="list-unstyled">
            <li>
                <span class="fa fa-fw fa-calendar"></span> 
                {{ $cm->date->format('M d, Y') }} · {{ date('h:i A', strtotime($cm->start_time)) }}
            </li>
            <li><span class="fa fa-fw fa-map-marker"></span> {{ $cm->location }}</li>
        </ul>
    </div>
    <div class="col-sm-6 text-right">
        @if ($cm->status == 'Scheduled')
            @if ($cm->signedUserIsHost())
                <a href="{{ '/cubemeets/'.$cm->slug.'/edit' }}" class="btn btn-sm btn-default">
                    <span class="fa fa-fw fa-pencil"></span> Edit
                </a>
                <a href="{{ '/cubemeets/'.$cm->slug.'/cancel' }}" class="btn btn-sm btn-danger">
                    <span class="fa fa-fw fa-times"></span> Cancel
                </a>
            @else
                @if ($cm->attendeeIsGoing())
                    {!! Form::open(['url' => 'cubemeets/'.$cm->slug.'/canceljoin', 'role' => 'form']) !!}
                        <button type="submit" class="btn btn-sm btn-primary">
                            <span class="fa fa-ban"> Not Going</span>
                        </button>
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['url' => 'cubemeets/'.$cm->slug.'/join', 'role' => 'form']) !!}
                        <button type="submit" class="btn btn-sm btn-primary">
                            <span class="fa fa-check"> Join</span>
                        </button>
                    {!! Form::close() !!}
                @endif
            @endif
        @elseif ($cm->status == 'Canceled')
            <ul class="list-unstyled">
                <li><span class="fa fa-fw fa-ban"></span> Cube meet is canceled.</li>
                <li><b>Reason:</b> {{ $cm->cancelation_reason }}</li>
            </ul>
        @endif
    </div>
</div>

<hr>

<div class="row">
    <div class="col-sm-12">
        <p>{{ $cm->description }}<p>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-sm-6">
        <h4>
            <span class="fa fa-fw fa-user"></span> 
            {{ $cuberCount = $cm->countCubers() }} 
            {{ $cuberCount > 1? 'Cubers': 'Cuber' }}
        </h4>
        <div style="padding-left: 30px">
            <ul class="list-unstyled">
                <li><a href="{{ '/'.$cm->hostUsername() }}">{{ $cm->hostName() }}</a></li>
                @foreach ($cm->getAttendees() as $attendee)
                    <li><a href="{{ '/'.$attendee->username() }}">{{ $attendee->name() }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-sm-6">

        <!-- Comments -->

    </div>
</div>

@stop
