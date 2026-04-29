<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title TennisClub</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <ul class="nav navbar-nav">
            <li><a href="{{route('members.index')}}">Members</a></li>
            <li><a href="{{route('members.create')}}">New Member</a></li>
        </ul>
        @include('layouts.navAuth')
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