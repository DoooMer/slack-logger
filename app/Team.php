<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель команды.
 *
 * @property string $id
 * @property string $name
 * @property string $icon
 * @property integer $internal_updated_at
 * @property string $created_at
 * @property string $updated_at
 */
class Team extends Model
{
    protected $fillable = ['id', 'name', 'icon'];

    public $incrementing = false;

    protected $keyType = 'string';

    /**
     * Связь с пользователями.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function users()
    {
        return $this->hasManyThrough(User::class, UserTeam::class, 'user_id', 'id', 'id', 'team_id');
    }
}
