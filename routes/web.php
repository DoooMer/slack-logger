<?php

Route::get('/', function () {
    return view('welcome');
});

Route::slackEventsWebhook('slack/events');