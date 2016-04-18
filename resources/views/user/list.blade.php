@extends('layouts.master')

@section('title')
@parent
| Users
@stop

@section('content')

<!-- Users -->

<div class="row" style="margin-top: 60px">

@foreach ($users as $user)

    <div class="col-sm-3" style="margin-bottom: 30px">
        <div class="col-sm-4" style="padding:0">
            <img class="img-responsive" src="https://placehold.it/75x75">
        </div>
        <div class="col-sm-8" style="padding:0">
            <ul class="list-unstyled">
                <li><a href="/{{ $user->profile->username }}">{{ $user->first_name.' '.$user->last_name }}</a></li>
                <li><i>Location</i></li>
            </ul>
        </div>
    </div>

@endforeach

</div>

<!-- /Users -->

@stop
