<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SlackApiService;
use App\Services\TeamService;
use App\Services\UserService;
use App\Team;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Авторизует пользователя через Slack.
     *
     * @param Request $request
     * @param SlackApiService $slackApiService
     * @param UserService $userService
     * @param TeamService $teamService
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loginBySlack(Request $request, SlackApiService $slackApiService, UserService $userService, TeamService $teamService)
    {
        Log::debug('Slack authentication response: ' . json_encode($request->all()));

        $response = $slackApiService->getAccessTokenByAuthCode($request->get('code'));

        if ($response && array_key_exists('ok', $response) && $response['ok'] === false) {
            Log::error("Login by slack: error: {$response['error']}");
            return redirect('/');
        }

        $accessToken = $response['access_token'];

        if ($accessToken === null) {
            return redirect('/');
        }

        Log::debug("Slack access token response: \n{$accessToken}");

        session()->put('user-access-token', $accessToken);

        $user = $userService->create(
            $response['user']['id'],
            $response['user']['name'],
            $response['user']['image_192']
        );

        $slackTeam = $response['team'];
        $team = Team::where('id', $slackTeam['id'])->first();

        if (!$team && $slackTeam) {
            $team = $teamService->create($slackTeam['id'], $slackTeam['name'], $slackTeam['image_102']);
        }

        if ($teamService->isNeedToUpdate($team)) {
            // @todo: отправить в очередь задание на обновление данных команды

        }

        // @todo: привязать пользователя к команде

        if (auth()->loginUsingId($user->id, true)) {
            $request->session()->regenerate();
            return redirect()->intended(route('messages', ['team' => $team->id]));
        }

        return redirect()->home();
    }

    /**
     * Разлогинивает пользователя.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();

        return redirect()->home();
    }
}
