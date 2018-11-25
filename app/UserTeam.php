<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель связи пользователей с командами.
 *
 * @property string $user_id
 * @property string $team_id
 * @property boolean $is_deleted
 */
class UserTeam extends Model
{
    protected $keyType = 'uuid';

    protected $fillable = ['id', 'user_id', 'team_id'];

    public $timestamps = false;

    /**
     * Связь с пользователем.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Связь с командой.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function team()
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }
}
