<?php

namespace App\Services;

use App\Team;
use App\UserTeam;
use Ramsey\Uuid\Uuid;

/**
 * Сервис команд.
 */
class TeamService
{
    /**
     * Создание команды.
     *
     * @param string $id
     * @param string $name
     * @param string $icon
     * @return Team|\Illuminate\Database\Eloquent\Model
     */
    public function create(string $id, string $name, string $icon): Team
    {
        return Team::query()->firstOrCreate(compact('id', 'name', 'icon'));
    }

    /**
     * Возвращает указатель на необходимость обновления данных.
     *
     * @param Team $team
     * @return bool
     */
    public function isNeedToUpdate(Team $team): bool
    {
        return $team->internal_updated_at === null || $team->internal_updated_at < strtotime('-4 hours');
    }

    /**
     * Привязка пользователя к команде.
     *
     * @param string $user_id
     * @param string $team_id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function assign(string $user_id, string $team_id)
    {
        $relation = UserTeam::query()->firstOrNew(compact('user_id', 'team_id'));

        if (!$relation->exists()) {
            $id = Uuid::uuid4()->toString();
            $relation->setAttribute('id', $id);
            $relation->save();
        }

        return $relation;
    }
}