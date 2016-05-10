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
    </div>
</div>

@include('partials.messages')

<!-- Cube Meets -->
<div class="row">

    {!! $cubemeets->render() !!}

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title ongoing">
                <span class="fa fa-play"></span> <b>Cube Meets</b>
            </h3>
        </div>
        @foreach ($cubemeets as $cm)
        <li class="list-group-item" style="margin: 0; padding: 0">
            <table class="table" style="margin: 0; padding: 0">
                <tr>
                    <td class="col-md-5">
                        <h4 class="list-group-item-heading">
                            {{ $cm['name'] }} <small>by {{ $cm->host()->getResults()->first_name.' '.$cm->host()->getResults()->last_name }}</small>
                        </h4>
                        <p class="list-group-item-text text-indent">
                            <span class="fa fa-map-marker"></span> {{ $cm->location }}
                        </p>
                        <p class="list-group-item-text text-indent">
                            <span class="fa fa-calendar"></span> Today
                        </p>
                        <p class="list-group-item-text text-indent">
                            <span class="fa fa-clock-o"></span> {{ date('h:i A', strtotime($cm->start_time)) }}
                        </p>
                        </td>
                    <td>
                        <p class="list-group-item-text">
                            <span class="fa fa-comment"></span> {{ str_limit($cm->description, 100) }}
                        </p>
                        <p class="list-group-item-text" style="margin-top: 10px">
                            <span class="fa fa-user"></span> {{ $cm->cubers()->where('status', 'Going')->count() + 1 }} expected Cuber(s) to attend
                        </p>
                    </td>
                    <td class="col-md-3">
                        @if ($cm->host()->getResults()->id == Auth::user()->id)
                            {!! Form::open(['method' => 'DELETE', 'class' => 'text-right', 'route' => ['cubemeets.destroy', $cm['id']]]) !!}
                                {!! Html::link('cubemeets/'.$cm->id.'/edit', 'Edit', ['class' => 'btn btn-sm btn-default']) !!}
                                {!! Html::link('cubemeets/'.$cm->id, 'View Details', ['class' => 'btn btn-sm btn-primary']) !!}
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
                                    {!! Html::link('cubemeets/'.$cm->id, 'View Details', ['class' => 'btn btn-sm btn-primary']) !!}
                                {!! Form::close() !!}
                                @else
                                {!! Form::open(['url' => 'cubemeets/'.$cm->id.'/join', 'role' => 'form']) !!}
                                    {!! Form::submit('Join', ['class' => 'btn btn-sm btn-primary']) !!}
                                    {!! Html::link('cubemeets/'.$cm->id, 'View Details', ['class' => 'btn btn-sm btn-primary']) !!}
                                {!! Form::close() !!}
                                @endif
                            </div>
                        @endif
                    </td>
                </tr>
            </table>
        </li>
        @endforeach
    </div>

    {!! $cubemeets->render() !!}

</div>
<!-- /Cube Meets -->

@stop
