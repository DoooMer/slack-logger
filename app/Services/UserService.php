<?php

namespace App\Services;

use App\User;

/**
 * Сервис пользователей.
 */
class UserService
{
    /**
     * Добавление пользователя.
     *
     * @param string $id
     * @param string $name
     * @param string $avatar
     * @return User
     */
    public function create(string $id, string $name, string $avatar): User
    {
        return User::query()->firstOrCreate(compact('id', 'name', 'avatar'));
    }
}