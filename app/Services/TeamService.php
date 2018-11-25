<?php

namespace App\Services;

use App\Team;

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
}