<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

/**
 * Модель мета информации сообщения.
 *
 * @property string $id
 * @property string $team_id
 * @property string $user_id
 * @property string $event_id
 * @property string $event_time
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 */
class MessageMeta extends Model
{
    use HybridRelations;

    /**
     * @inheritdoc
     */
    protected $table = 'messages';
    /**
     * @protected
     */
    protected $fillable = ['id', 'team_id', 'user_id', 'event_id', 'event_time', 'type'];

    protected $keyType = 'string';

    /**
     * Связь с исходным сообщением.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function source()
    {
        return $this->hasOne(Message::class, 'event.client_msg_id', 'id');
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
