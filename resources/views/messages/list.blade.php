<?php
/** @var \Illuminate\Database\Eloquent\Collection $messages */
?>
@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-2">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">#channel 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">#channel 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">#channel 3</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-6 col-md-10">
            <ul class="list-group">
                @foreach($messages as $message)
                    <li class="list-group-item">
                        <b>{{ $message->source->event['user'] }}</b> <span class="text-muted">posted to {{ $message->source->team_id }}</span>
                        <br>
                        {{ $message->source->event['text'] }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection