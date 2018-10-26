<?php

Route::get('/', function () {
    return view('welcome');
});

\Illuminate\Support\Facades\Route::slackEventsWebhook('slack/events');