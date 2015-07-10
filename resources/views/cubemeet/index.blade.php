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
        {!! Html::link('cubemeets/create', 'Set Cube Meet', ['class' => 'btn btn-sm btn-default']) !!}
        </span>
    </div>
</div>

<!-- Cube Meets -->
<div class="row">

    <!-- Ongoing Cube Meets -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title ongoing">
                <span class="fa fa-play"></span> <b>Ongoing Cube Meets</b>
            </h3>
        </div>
        </ul>
    </div>

    <!-- Upcoming Cube Meets -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title upcoming">
                <span class="fa fa-thumb-tack"></span> <b>Upcoming Cube Meets</b>
            </h3>
        </div>
        @foreach ($upcoming as $cm)
        <li class="list-group-item" style="margin: 0; padding: 0">
            <table class="table" style="margin: 0; padding: 0">
                <tr>
                    <td class="col-md-5">
                        <h4 class="list-group-item-heading">
                            {{ $cm['name'] }} <small>by {{ $cm['host']['first_name'].' '.$cm['host']['last_name'] }}</small>
                        </h4>
                        <p class="list-group-item-text text-indent">
                            <span class="fa fa-map-marker"></span> {{ $cm['location'] }}
                        </p>
                        <p class="list-group-item-text text-indent">
                            <span class="fa fa-calendar"></span> {{ $cm['date'] }}
                        </p>
                        <p class="list-group-item-text text-indent">
                            <span class="fa fa-clock-o"></span> {{ $cm['start_time'] }}
                        </p>
                    </td>
                    <td><span class="fa fa-comment"></span> {{ $cm['description'] }}</td>
                    <td>
                        @if ($cm['host']['id'] == Auth::user()->id)
                            {!! Form::open(['method' => 'DELETE', 'class' => 'text-right', 'route' => ['cubemeets.destroy', $cm['id']]]) !!}
                                {!! Html::link('cubemeets/'.$cm['id'].'/edit', 'Edit', ['class' => 'btn btn-sm btn-default']) !!}
                                {!! Html::link('cubemeets/'.$cm['id'], 'View Details', ['class' => 'btn btn-sm btn-primary']) !!}
                                {!! Form::submit('Cancel', ['class' => 'btn btn-sm btn-danger']) !!}
                            {!! Form::close() !!}
                        @else
                            <div class="text-right">
                                {!! Form::open(['url' => 'cubemeets/'.$cm['id'].'/join', 'role' => 'form']) !!}
                                    {!! Form::submit('Join', ['class' => 'btn btn-sm btn-primary']) !!}
                                    {!! Html::link('cubemeets/'.$cm['id'], 'View Details', ['class' => 'btn btn-sm btn-primary']) !!}
                                {!! Form::close() !!}
                            </div>
                        @endif
                    </td>
                </tr>
            </table>
        </li>
        @endforeach
    </div>

    <!-- Successful Cube Meets -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title success">
                <span class="fa fa-check"></span> <b>Successful Cube Meets</b>
            </h3>
        </div>
    </div>

    <!-- Canceled Cube Meets -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title canceled">
                <span class="fa fa-times"></span> <b>Canceled Cube Meets</b>
            </h3>
        </div>
        @foreach ($canceled as $cm)
        <li class="list-group-item" style="margin: 0; padding: 0">
            <table class="table" style="margin: 0; padding: 0">
                <tr>
                    <td class="col-md-5">
                        <h4 class="list-group-item-heading">
                            {{ $cm['name'] }} <small>by {{ $cm['host']['first_name'].' '.$cm['host']['last_name'] }}</small>
                        </h4>
                        <p class="list-group-item-text text-indent">
                            <span class="fa fa-map-marker"></span> {{ $cm['location'] }}
                        </p>
                        <p class="list-group-item-text text-indent">
                            <span class="fa fa-calendar"></span> {{ $cm['date'] }}
                        </p>
                        <p class="list-group-item-text text-indent">
                            <span class="fa fa-clock-o"></span> {{ $cm['start_time'] }}
                        </p>
                    </td>
                    <td><span class="fa fa-comment"></span> {{ $cm['description'] }}</td>
                    <td>
                        <div class="text-right">
                            {!! Html::link('cubemeets/'.$cm['id'], 'View Details', ['class' => 'btn btn-sm btn-primary']) !!}
                        </div>
                    </td>
                </tr>
            </table>
        </li>
        @endforeach
    </div>
</div>
<!-- /Cube Meets -->

@stop
