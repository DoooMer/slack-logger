<?php

namespace App\Http\Controllers;

use App\MessageMeta;
use App\Team;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * Контроллер сообщений.
 */
class MessageController extends Controller
{
    /**
     * Вывод списка сообщений для авторизованного пользователя из заданной команды.
     *
     * @param Request $request
     * @param Team $team
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Team $team)
    {
        /** @var User $user */
        $user = $request->user();
        $accessToken = Session::get('user-access-token');

        if ($accessToken === null) {
            return redirect('/logout');
        }

        /** @var Collection $messages */
        $messages = MessageMeta::with(['source', 'team'])
            ->where('user_id', '=', $user->id)
            ->where('team_id', '=', $team->id)
            ->get();

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
