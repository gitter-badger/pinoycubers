@extends('layouts.master')

@section('title')
@parent
@stop

@section('content')

<div class="hidden-xs">
    <div class="jumbotron home-cover">
        <div class="hidden-sm">
            <h1>Pinoy Cubers Association</h1>
        </div>
        <div class="visible-sm">
            <h1>Pinoy Cubers Association</h1>
        </div>
        <p class="lead">Powered by PCADevTeam</p>
        <a class="btn btn-lg btn-success" href="https://www.facebook.com/groups/PINOYCUBERS/"><i class="fa fa-facebook-square"></i> Join us at Facebook!</a>
        <img src="{{URL::to('/assets/img/pca.png') }}" class="home-logo hidden-sm hidden-md">
    </div>
</div>

<div class="visible-xs">
    <div class="jumbotron">
        <h1>Pinoy Cubers Association</h1>
        <p class="lead">Powered by PCADevTeam</p>
        <a class="btn btn-lg btn-success" href="https://www.facebook.com/groups/PINOYCUBERS/"><i class="fa fa-facebook-square"></i> Join us at Facebook!</a>
    </div>
</div>

<div class="contribute-band">
    <div class="container">
        <p>Want to help with the site? We accept pull requests!&nbsp;&nbsp;<a href="https://github.com/geocine/pinoycubers"><i class="fa fa-github"></i>Find us on Github</a></p>
    </div>
</div>

<div class="row">

    <div class="col-md-4 col-xs-12">
        <h2>Unofficial Records</h2>
        <p>Compare your record time with other cubers in the Philippines. We will verify your record time and post it on the unofficial Philippine record list</p>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <h2>Learning Resources</h2>
        <p>Share algorithms and checkout the algorithm database. Watch/Read puzzle solving tutorials</p>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <h2>Events</h2>
        <p>Check upcoming official competitions and see results online. View the calendar for cubemeets near you</p>
    </div>

</div>


<div class="row">

    <div class="col-md-4 col-xs-12">
        <h2>Group Discussions</h2>
        <p>Participate in online group discussions about your favorite puzzles</p>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <h2>User Profiles</h2>
        <p>Contribute to the community and earn badges. Post your personal bests and tell something about yourself.</p>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <h2>Online Competitions</h2>
        <p>Compete online with your friend on your favorite puzzles in real time. Host and join a competition using the web interface</p>
    </div>

</div>


@stop