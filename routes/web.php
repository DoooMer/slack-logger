<?php

Route::get('/', function () {
    return view('welcome');
});

\Illuminate\Support\Facades\Route::slackEventsWebhook('slack/events');

Route::get('/auth', function (\Illuminate\Http\Request $request) {

    \Illuminate\Support\Facades\Log::debug('Slack authentication response: ' . json_encode($request->all()));

    // TODO: вынести в сервис
    $client = new \GuzzleHttp\Client([
        'base_uri' => 'https://slack.com',
    ]);
    $authResponse = $client->post('/api/oauth.access', [
        \GuzzleHttp\RequestOptions::FORM_PARAMS => [
            'client_id' => '96563862338.463662295171',
            'client_secret' => 'b4d6b4e020a709ed8af024cc18656b62',
            'code' => $request->get('code'),
            'redirect_uri' => 'http://slacklogger.local/auth',
        ],
    ]);
    $authResponseDecoded = json_decode($authResponse->getBody()->getContents(), true);

    if ($authResponseDecoded && array_key_exists('ok', $authResponseDecoded) && $authResponseDecoded['ok'] === false) {
        \Illuminate\Support\Facades\Log::error("Login by slack: error: {$authResponseDecoded['error']}");
        return redirect('/');
    }

    \Illuminate\Support\Facades\Log::debug("Slack access token response: \n{$authResponseDecoded}");

    // TODO: авторизовать пользователя, сделать редирект в профиль
    return view('profile', ['user' => $authResponseDecoded['user'], 'team' => $authResponseDecoded['team']]);
});