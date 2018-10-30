<?php

\Illuminate\Support\Facades\Route::get('/', function () {
    return view('welcome');
})->name('home');

\Illuminate\Support\Facades\Route::slackEventsWebhook('slack/events');

\Illuminate\Support\Facades\Route::get('/profile', function (\Illuminate\Http\Request $request) {

    /** @var \App\User $user */
    $user = $request->user();

    return view('profile', ['user' => ['name' => $user->name, 'image_192' => $user->avatar], 'team' => ['name' => '', 'image_102' => '']]);

})->name('profile')->middleware('auth');

\Illuminate\Support\Facades\Route::get('/auth', function (\Illuminate\Http\Request $request) {

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
            'redirect_uri' => route('login', [], true),
        ],
    ]);
    $authResponseRaw = $authResponse->getBody()->getContents();
    $authResponseDecoded = json_decode($authResponseRaw, true);

    if ($authResponseDecoded && array_key_exists('ok', $authResponseDecoded) && $authResponseDecoded['ok'] === false) {
        \Illuminate\Support\Facades\Log::error("Login by slack: error: {$authResponseDecoded['error']}");
        return redirect('/');
    }

    \Illuminate\Support\Facades\Log::debug("Slack access token response: \n{$authResponseRaw}");

    $user = \App\User::query()->firstOrCreate(['id' => $authResponseDecoded['user']['id']]);

    if (\Illuminate\Support\Facades\Auth::guard()->loginUsingId($user->id, true)) {
        $request->session()->regenerate();
        return redirect()->intended('profile');
    }

    return redirect()->home();

})->name('login');

\Illuminate\Support\Facades\Route::get('/logout', function (\Illuminate\Http\Request $request) {

    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();

    return redirect()->home();

})->name('logout')->middleware('auth');