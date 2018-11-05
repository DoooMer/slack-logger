<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Slack logger (beta) @yield('title')</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse">
        @if (Route::has('login'))
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Team 1
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Team 1</a>
                        <a class="dropdown-item" href="#">Team 2</a>
                        <a class="dropdown-item" href="#">Team 3</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item">
                        <span class="navbar-text mr-3"><i class="fas fa-user"></i> {{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"><i class="fas fa-power-off"></i> Выйти</a>
                    </li>
                @endauth
            </ul>
        @endif
    </div>
</nav>
<div class="container-fluid">

    @yield('content')

</div>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
</body>
</html>
