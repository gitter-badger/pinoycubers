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
        <a href="/cubemeets/set/" class="btn btn-sm btn-default">
            <span class="fa fa-fw fa-plus"></span> Set a Cube Meet
        </a>
    </div>
</div>

@include('partials.messages')

<!-- Cube Meets -->

{!! $cubemeets->render() !!}

<hr>

@foreach ($cubemeets as $cm)
<div class="row">
    <div class="col-sm-5">
        <ul class="list-unstyled">
            <li>
                <b><a href="{{ '/cubemeets/'.$cm->slug }}">{{ $cm->name }}</a></b>
                <small>by <a href="{{ '/'.$cm->hostUsername() }}">{{ $cm->hostName() }}</a></small>
            </li>
            <li><span class="fa fa-fw fa-calendar"></span> {{ $cm->date->format('M d, Y') }} · {{ date('h:i A', strtotime($cm->start_time)) }}</li>
        </ul>
    </div>
    <div class="col-sm-4">
        <ul class="list-unstyled">
            <li><span class="fa fa-fw fa-map-marker"></span> {{ $cm->location }}</li>
            <li>
                <span class="fa fa-fw fa-user"></span> 
                {{ $cuberCount = $cm->countCubers() }} 
                {{ $cuberCount > 1? 'Cubers': 'Cuber' }}
            </li>
        </ul>
    </div>
    <div class="col-sm-3 text-right">
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
            </ul>
        @endif
    </div>
</div>
<hr>
@endforeach
        
{!! $cubemeets->render() !!}

<!-- /Cube Meets -->

@stop
