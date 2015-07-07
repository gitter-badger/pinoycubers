@extends('layouts.master')

@section('title')
@parent
| Profile
@stop

@section('content')

<div class="row">
    <div class="col-md-3 col-sm-4 col-xs-12">
        <span class="tooltipped tooltipped-s" aria-label="Change your avatar">
        <a href="/settings/profile" class="prof-avatar" ><img class="avatar lg-avatar" src="{{$photo}}" ></a>
        </span>

        <h1 class="prof-names">
            <span class="prof-fullname" >{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
            <span class="prof-username" ></span>
        </h1>
        <ul class="prof-details">


            <li class="prof-detail"><i class="fa fa-map-marker"></i>Philippines</li>
            <li class="prof-detail"><i class="fa fa-clock-o"></i><span class="join-label">Joined on </span><span class="join-date">{{Auth::user()->getJoinedDate()}}</span></li>
        </ul>


        <div class="prof-stats">
            <a class="prof-stat" href="/{{Auth::user()->profile->username}}/followers">
                <strong class="prof-stat-count">9</strong>
                followers
            </a>
            <a class="prof-stat" href="/{{Auth::user()->profile->username}}/stars">
                <strong class="prof-stat-count">136</strong>
                starred
            </a>
            <a class="prof-stat" href="/{{Auth::user()->profile->username}}/following">
                <strong class="prof-stat-count">26</strong>
                following
            </a>
        </div>
    </div>

    <div class="col-md-9 col-sm-8 col-xs-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#">Activities</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Records</a></li>
        </ul>
    </div>
</div>

@stop