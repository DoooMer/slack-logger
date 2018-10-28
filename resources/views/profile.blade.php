@extends('layouts.main')

@section('title', '- Profile')

@section('content')
    <div class="content">

        <img src="{{ $user['image_192'] }}" class="rounded mx-auto d-block" alt="{{ $user['name'] }}">
        <h2 class="m-b-md">{{ $user['name'] }}</h2>

        <img src="{{ $team['image_102'] }}" class="rounded mx-auto d-block" alt="{{ $team['name'] }}">
        <h3 class="m-b-md">{{ $team['name'] }}</h3>

    </div>
@endsection