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

<!-- Nav -->
<div class="row">
    <div class="cols-sm-12">
        <ul class="nav nav-tabs">
            <li role="presentation"{!! $category == 'today'? ' class="active"': '' !!}><a href="/cubemeets?view=today">today</a></li>
            <li role="presentation"{!! $category == 'newest'? ' class="active"': '' !!}><a href="/cubemeets?view=newest">newest</a></li>
            <li role="presentation"{!! $category == 'upcoming'? ' class="active"': '' !!}><a href="/cubemeets?view=upcoming">upcoming</a></li>
            <li role="presentation"{!! $category == 'canceled'? ' class="active"': '' !!}><a href="/cubemeets?view=canceled">canceled</a></li>
            <li role="presentation"{!! $category == 'past'? ' class="active"': '' !!}><a href="/cubemeets?view=past">past</a></li>
        </ul>
    </div>
</div>

@include('partials.messages')

<!-- Cube Meets -->

{!! $cubemeets->render() !!}

<hr>

@if ($cubemeets->count() == 0)
<div class="row">
    <div class="col-sm-12 text-center">
        <h3>No cubemeet(s) to show</h3>
    </div>
</div>
@endif

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
        @include('cubemeets._actions')
    </div>
</div>
<hr>
@endforeach
        
{!! $cubemeets->render() !!}

<!-- /Cube Meets -->

@stop
