@extends('layouts.main')

@section('title', '- Profile')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 align-content-center">
                <img src="{{ $user['image_192'] }}" class="rounded mx-auto d-block" alt="{{ $user['name'] }}">
                <br>
                <h2 class="text-center">{{ $user['name'] }}</h2>
                <br>
                <br>
                <img src="{{ $team['image_102'] }}" class="rounded mx-auto d-block" alt="{{ $team['name'] }}">
                <br>
                <h3 class="text-center">{{ $team['name'] }}</h3>
            </div>
        </div>
    </div>
@endsection