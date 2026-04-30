<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title TennisClub</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <ul class="nav navbar-nav">
            <li><a href="{{route('members.index')}}">Members</a></li>
            <li><a href="{{route('members.create')}}">New Member</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right" style="margin-right:10px">
            @if(Auth::check())
                @if(Auth::user()->hasRole('System Admin'))
                    @include('layouts.adminmenu')
                @endif
                <li><a href="{!! route('logout') !!}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            @else
                <li><a href="{!! route('login') !!}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <li><a href="{!! route('register') !!}"><span class="glyphicon glyphicon-user"></span> Register</a></li>
            @endif
        </ul>
    </nav>
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8"> @yield('content') </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
</body>
</html>