@extends('layouts.master')

@section('title')
@parent
| Profile
@stop

@section('content')

<div class="row">
    <div class="col-md-3 col-sm-4 col-xs-12">
        <span class="tooltipped tooltipped-s" aria-label="Change your avatar">
        <a href="/edit/profile" class="prof-avatar"><img class="avatar lg-avatar" src="{{ $user->photo? $user->photo: 'https://placehold.it/200x200?text=No Avatar' }}" ></a>
        </span>

        <h1 class="prof-names">
            <span class="prof-fullname">{{ $user->profile->first_name.' '.$user->profile->last_name }}</span>
            <span class="prof-username"></span>
        </h1>
        <ul class="prof-details">
            @if($user->profile->location)
            <li class="prof-detail"><i class="fa fa-map-marker"></i>{{ $user->profile->location }}</li>
            @endif
            <li class="prof-detail"><i class="fa fa-clock-o"></i><span class="join-label">Joined on </span><span class="join-date">{{ $user->getJoinedDate() }}</span></li>
            @if($user->profile->wca_id)
            <li class="prof-detail">WCA ID: <a href="{{ 'https://www.worldcubeassociation.org/results/p.php?i='.$user->profile->wca_id }}" target="_blank">{{ $user->profile->wca_id }}</a></li>
            @endif
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