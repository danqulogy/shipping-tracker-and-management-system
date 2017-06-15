<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>mTrackers | @yield('page_title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('libs/bootstrap/dist/css/bootstrap.min.css')}}" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('fonts/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/guest.css')}}">
    @yield('local-styles')
</head>
<body class="">

    <nav id="app-navbar" class="navbar navbar-toggleable-md container navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand text-bold" href="#"><i class="fa fa-truck" aria-hidden="true"></i> mTrackers | Administrative Backoffice</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/login')}}"><i class="fa fa-lock"></i> Sign In</a>
            </li>
            <li class="nav-divider"></li>
            <li class="nav-item">
                <a class="nav-link" href="#"> <i class="fa fa-info"></i> About Us</a>
            </li>
        </ul>

        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('password.request') }}"><i class="fa fa-question-circle"></i> Forgotten your Password </a>
            </li>
        </ul>
    </div>
</nav>

    @yield('content')

    <!-- Scripts -->
    <script src="{{asset('libs\jquery\dist\jquery.slim.min.js')}}" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="{{asset('libs\tether\dist\js\tether.min.js')}}" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="{{asset('libs\bootstrap\dist\js\bootstrap.min.js')}}" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>
