<?php
/** @var \Illuminate\Database\Eloquent\Collection $messages */
/** @var \App\Team $team  */
?>
@extends('layouts.messages')
@section('team_name', $team['name'])
@section('messages')
    <div class="row">
        <div class="col-sm-6 col-md-2">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('messages', ['team' => $team['id']]) }}">#{{ $team['name'] }}</a>
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
                        <b>{{ $message->source->event['user'] }}</b> <span class="text-muted">posted to {{ $message->team->name }}</span>
                        <br>
                        {{ $message->source->event['text'] }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection