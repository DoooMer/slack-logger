<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

/**
 * Модель сообщения (исходного).
 */
class Message extends Eloquent
{
    /**
     * @inheritdoc
     */
    protected $collection = 'messages_collection';
    /**
     * @inheritdoc
     */
    protected $connection = 'mongodb';
}
