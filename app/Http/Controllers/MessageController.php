<?php

namespace App\Http\Controllers;

use App\MessageMeta;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 *
 */
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        /** @var Collection $messages */
        $messages = MessageMeta::with('source')->where('user_id', '=', $user->id)->get();

        $client = new \GuzzleHttp\Client([
            'base_uri' => 'https://slack.com',
        ]);
        $teamsResponse = $client->get('/api/team.info', [
            \GuzzleHttp\RequestOptions::QUERY => [
                'token' => Session::get('user-access-token'),
            ],
        ]);
        $teamsResponseRaw = $teamsResponse->getBody()->getContents();
        $teamsResponseDecoded = json_decode($teamsResponseRaw, true);

        $team = [
            'name' => $teamsResponseDecoded['team']['name'] ?? null,
            'icon' => $teamsResponseDecoded['team']['icon']['image_44'] ?? null,
        ];

        return view('messages.list', compact('messages', 'team'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
