<!DOCTYPE html>
<html>
    <head>
        <title>
            @section('title')
               Pinoy Cubers
            @show
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta property="og:site_name" content="Pinoy Cubers" />
        <meta property="og:title" content="Pinoy Cubers Association" />
        <meta property="og:url" content="http://pinoycubers.org" />
        <meta property="og:type" content="object" />
        <meta property="og:image" content="{{ URL::to('/assets/img/graph.png') }}" />
        <meta property="og:description" content="Pinoy Cubers Association - unofficial records, learning resources, events, group discussions, user profiles, online competitions" />
        <meta name="description" content="Pinoy Cubers Association - unofficial records, learning resources, events, group discussions, user profiles, online competitions">

        <!-- CSS are placed here -->
        {!! Html::style('/packages/css/bootstrap.css') !!}
        {!! Html::style('/packages/css/font-awesome.min.css') !!}
        {!! Html::style('/packages/css/site.css?v=6') !!}

        <style>
            #img_banner img{
                width:75%; height: 75%;
            }
        </style>
    </head>

    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                  <a class="navbar-brand" href="/">PINOY CUBERS</a>
                </div>


                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#">Official Competitions</a>
                        </li>
                        <li>
                            <a href="/cubemeets">Cube Meets</a>
                        </li>
                        <li>
                            <a href="#">Timer</a>
                        </li>
                        <li>
                            <a href="#">Users</a>
                        </li>
                        <li>
                            <a href="#">Forums</a>
                        </li>
                        <li>
                            <a href="#">Records</a>
                        </li>
                        @if(true)
                        <li>
                            <a href="#">Market</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Learn <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="fa fa-files-o"></i> Wiki</a></li>
                                <li><a href="#"><i class="fa fa-th"></i> Algorithms</a></li>
                                <li><a href="#"><i class="fa fa-video-camera"></i> Videos</a></li>
                                <li><a href="#"><i class="fa fa-link"></i>Links</a></li>
                            </ul>
                        </li>
                        @endif
                        @if (Auth::check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                @if (!empty(Auth::user()->profile->access_token))
                                    <img alt="{{Auth::user()->first_name}} {{Auth::user()->last_name}}" class="avatar sm-avatar" height="20" src="https://graph.facebook.com/{{{Auth::user()->profile->username}}}/picture?type=small" width="20">
                                @else
                                    <img alt="{{Auth::user()->first_name}} {{Auth::user()->last_name}}" class="avatar sm-avatar" height="20" src="http://placehold.it/20x20" width="20">
                                @endif
                                {{Auth::user()->first_name}} {{Auth::user()->last_name}} <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/#"><i class="fa fa-edit"></i> Edit Profile</a></li>
                                <li><a href="/logout"><i class="fa fa-power-off"></i> Log Out</a></li>
                            </ul>
                        </li>
                        @else
                        <li>
                            <a href="/login">Login</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div><!-- /.container-fluid -->
        </nav>

        <!-- Container -->
        <div class="container">
            <!-- Content -->
            @yield('content')

        </div>

        <div id="footer">
            <div class="container">
            <p class="text-muted text-left col-md-6 no-padding">This site is maintained by <a href="https://www.facebook.com/geocine">Aivan Monceller</a> | <a href="https://www.facebook.com/groups/PCADevTeam/">PCA DevTeam</a></p>
            <p class="text-muted text-right col-md-6 no-padding hidden-sm hidden-xs">Server hosting provided by <a href="https://www.facebook.com/omar.lozada.7965">Omar Lozada</a></p>
            </div>
        </div>

        <!-- Scripts are placed here -->
        {{ HTML::script('packages/js/jquery-2.1.0.js')}}
        {{ HTML::script('packages/js/bootstrap.js')}}

        <script type="text/javascript">
            if (window.location.hash == '#_=_'){
                history.replaceState
                    ? history.replaceState(null, null, window.location.href.split('#')[0])
                    : window.location.hash = '';
            }
        </script>
    </body>
</html>