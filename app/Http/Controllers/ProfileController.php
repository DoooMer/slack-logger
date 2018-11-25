<?php

namespace App\Http\Controllers;

use App\Services\SlackApiService;
use App\Services\TeamService;
use App\Team;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    private $slackApiService;
    private $teamService;

    public function __construct(SlackApiService $slackApiService, TeamService $teamService)
    {
        $this->slackApiService = $slackApiService;
        $this->teamService = $teamService;
    }

    public function show(Request $request)
    {
        /** @var \App\User $user */
        $user = $request->user();

        $slackTeam = $this->slackApiService->getTeam(Session::get('user-access-token'));
        /** @var Team $team */
        $team = Team::where('id', $slackTeam['id'])->first();
//        $slackTeam = $this->getTeamInfo($client);

        // @todo: проверить необходимость обновления данных команды
        if ($this->teamService->isNeedToUpdate($team)) {
            // @todo: отправить в очередь задание на обновление данных команды

        }

//        $this->getUsersList($client);
//        $this->getChannelsList($client);

        $userProfile = ['name' => $user->name, 'image_192' => $user->avatar];
        $userTeam = ['name' => $team->name ?? '', 'image_102' => $team->icon ?? ''];

        return view('profile', ['user' => $userProfile, 'team' => $userTeam]);
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