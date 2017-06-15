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
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/guest.css')}}">
    @yield('local-styles')
</head>
<body class="">

    <nav id="app-navbar" class="navbar  navbar-toggleable-md container navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand text-bold" href="#"><i class="fa fa-truck" aria-hidden="true"></i> mTrackers | BackOffice</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @if (Auth::guest())
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/login')}}"><i class="fa fa-lock"></i> Sign In</a>
                </li>
            @endif

            <li class="nav-item {{$key=='agents'?'active':''}}">
                <a class="nav-link" href="{{url('/home')}}"><i class="fa fa-send"></i> Agents  </a>
            </li>

            <li class="nav-item {{$key=='recipients'?'active':''}}">
                <a class="nav-link" href="{{url('/recipients')}}"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i> Recipients</a>
            </li>

            <li class="nav-item {{$key=='containers'?'active':''}}">
                <a class="nav-link" href="{{url('/containers')}}"><i class="fa fa-ship"></i> Containers</a>
            </li>

            <li class="nav-item {{$key=='transactions'?'active':''}}">
                <a class="nav-link" href="{{url('/transactions')}}"><i class="fa fa-cubes"></i> Transactions</a>
            </li>

            <li class="nav-item {{$key=='users'?'active':''}}">
                <a class="nav-link" href="{{url('/users')}}"><i class="fa fa-users"></i> Manage Users</a>
            </li>

                <li style="background: black;color: white; border-radius: 5px; text-decoration:none; padding: 5px; font-weight: 700; float: right; margin-left:50px;" class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Welcome {{ Auth::user()->name }}!<span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>

        </ul>

        <ul class="navbar-nav navbar-right">
            @if (Auth::guest())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('password.request') }}"><i class="fa fa-question-circle"></i> Forgotten your Password </a>
                </li>
            @endif
        </ul>
    </div>
</nav>


        @yield('content')


    <!-- Scripts -->
    <script src="{{asset('libs\jquery\dist\jquery.slim.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{asset('libs\tether\dist\js\tether.min.js')}}" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="{{asset('libs\bootstrap\dist\js\bootstrap.min.js')}}" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>

    <script>
        $(document).ready(function () {
           $('.table').DataTable();
        });
    </script>
</body>
</html>
