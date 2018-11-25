@extends('layouts.main')

@section('title', '- Profile')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 align-content-center">
                <img src="{{ $user['avatar'] }}" class="rounded mx-auto d-block" alt="{{ $user['name'] }}">
                <br>
                <h2 class="text-center">{{ $user['name'] }}</h2>
            </div>
            <div class="col-md-12 align-content-center">
                {{-- ссылки на сообщения в командах --}}
            </div>
        </div>
    </div>
@endsection