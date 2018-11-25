<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель канала в команде.
 *
 * @property string $id
 * @property string $name
 * @property boolean $is_channel
 * @property boolean $is_group
 * @property boolean $is_im
 * @property boolean $is_archived
 * @property string $user_id
 */
class Channel extends Model
{
    protected $fillable = ['id', 'name', 'is_channel', 'is_group', 'is_im', 'is_archived', 'user_id'];

    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * Связь с командой.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function team()
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }

    /**
     * Связь с пользователем.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
