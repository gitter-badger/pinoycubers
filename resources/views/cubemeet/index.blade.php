@extends('layouts.master')

@section('title')
@parent
| Cube Meets
@stop

@section('content')

<div class="row">
    <h2>Cube Meets</h2>
    {!! Html::link('/cubemeets/create', 'Set Cube Meet', ['class' => 'btn btn-sm btn-default']) !!}

    <hr>

    <h3>CM Name <small>by name</small></h3>
    <ul>
        <li>Location:</li>
        <li>Date:</li>
        <li>Start Time:</li>
    </ul>
</div>
<div class="row">
    {!! Html::link('#', 'Join', ['class' => 'btn btn-sm btn-primary']) !!}
    {!! Html::link('#', 'View Details', ['class' => 'btn btn-sm btn-primary']) !!}
</div>

<hr>

@stop
