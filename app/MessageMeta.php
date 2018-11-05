<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

/**
 * Модель мета информации сообщения.
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

    public function source()
    {
        return $this->hasOne(Message::class, 'event.client_msg_id', 'id');
    }

    public function getKeyType()
    {
        return 'string';
    }
}
