<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Модель пользователя.
 *
 * @property string $id
 * @property string $name
 * @property string $avatar
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'avatar',
    ];

    protected $keyType = 'string';

    /**
     * @inheritdoc
     */
    public function getAuthPassword()
    {
        return '';
    }
}
