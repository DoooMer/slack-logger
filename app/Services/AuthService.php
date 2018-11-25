<?php

namespace App\Services;

class AuthService
{
    private $slackApiService;

    public function __construct(SlackApiService $slackApiService)
    {
        $this->slackApiService = $slackApiService;
    }

    /**
     * Получение токена доступа пользователя по коду авторизации.
     *
     * @param string $code
     * @return string|null
     */
    public function oauthLoginByCode(string $code): ?string
    {
        $response = $this->slackApiService->getAccessTokenByAuthCode($code);

        if ($response && array_key_exists('ok', $response) && $response['ok'] === false) {
            \Illuminate\Support\Facades\Log::error("Login by slack: error: {$response['error']}");
            return null;
        }

        return $response['access_token'];
    }
}