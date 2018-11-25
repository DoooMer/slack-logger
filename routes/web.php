<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::slackEventsWebhook('slack/events');

Route::get('/profile', 'ProfileController@show')
    ->name('profile')
    ->middleware('auth');

Route::get('/auth', 'Auth\LoginController@loginBySlack')
    ->name('login');

Route::get('/logout', 'Auth\LoginController@logout')
    ->name('logout')
    ->middleware('auth');

Route::get('/messages', 'MessageController@index')
    ->name('messages')
    ->middleware('auth');