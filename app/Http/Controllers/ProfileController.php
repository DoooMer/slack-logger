<?php

namespace App\Http\Controllers;

use App\Services\SlackApiService;
use App\Team;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * Контроллер профиля пользователя.
 */
class ProfileController extends Controller
{
    /**
     * Вывод страницы профиля.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        /** @var \App\User $user */
        $user = $request->user();
        $accessToken = Session::get('user-access-token');

        if ($accessToken === null) {
            return redirect('/logout');
        }

        return view('profile', compact('user'));
    }

    private function getTeamInfo(Client $client)
    {
        $teamDataResponse = $client->get('/api/team.info', [
            \GuzzleHttp\RequestOptions::QUERY => [
                'token' => Session::get('user-access-token'),
            ],
        ]);
        $teamDataResponseRaw = $teamDataResponse->getBody()->getContents();
        $teamDataResponseDecoded = json_decode($teamDataResponseRaw, true);

        return $teamDataResponseDecoded['team'];
    }

    private function getUsersList(Client $client)
    {
        $usersResponse = $client->get('/api/users.list', [
            \GuzzleHttp\RequestOptions::QUERY => [
                'token' => Session::get('user-access-token'),
//            'limit' => 2,
            ],
        ]);
        $usersResponseRaw = $usersResponse->getBody()->getContents();
        $usersResponseDecoded = json_decode($usersResponseRaw, true);
//    dd(array_column($usersResponseDecoded['members'], 'name', 'id'), $usersResponseDecoded['response_metadata']['next_cursor']);
//    var_dump(array_column($usersResponseDecoded['members'], 'name', 'id'));
    }

    private function getChannelsList(Client $client)
    {
        $channelsResponse = $client->get('/api/conversations.list', [
            \GuzzleHttp\RequestOptions::QUERY => [
                'token' => Session::get('user-access-token'),
//            'limit' => 2,
                'types' => 'public_channel,private_channel,mpim,im',
            ],
        ]);
        $channelsResponseRaw = $channelsResponse->getBody()->getContents();
        $channelsResponseDecoded = json_decode($channelsResponseRaw, true);
//    dd($channelsResponseDecoded, $channelsResponseDecoded['response_metadata']['next_cursor'] ?? null);
//    var_dump(array_column($channelsResponseDecoded['channels'], 'name', 'id'));
    }
}