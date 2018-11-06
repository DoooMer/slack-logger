@extends('layouts.main')
@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse">
            @if (Route::has('login'))
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @yield('team_name')
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
        @yield('messages')
    </div>
@endsection