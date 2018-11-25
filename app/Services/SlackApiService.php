<?php

namespace App\Services;

use GuzzleHttp\Client;

/**
 * Сервис для работы со Slack Web API.
 */
class SlackApiService
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Возвращает данные команды пользователя.
     *
     * @param string $token
     * @return array
     */
    public function getTeam(string $token)
    {
        $response = $this->client->get('/api/team.info', [
            \GuzzleHttp\RequestOptions::QUERY => compact('token'),
        ]);
        $responseRaw = $response->getBody()->getContents();
        $responseDecoded = json_decode($responseRaw, true);

        return $responseDecoded['team'];
    }

    /**
     * Возвращает всех пользователей команды.
     *
     * @param string $token
     * @return array
     */
    public function getUsersByTeam(string $token)
    {
        return [];
    }

    /**
     * Возвращает все каналы команды.
     *
     * @param string $token
     * @param string $types
     * @return array
     */
    public function getChannelsByTeam(string $token, string $types = 'public_channel,private_channel,mpim,im')
    {
        return [];
    }

    /**
     * Получение токена доступа по коду авторизации.
     *
     * @param string $code
     * @return array
     */
    public function getAccessTokenByAuthCode(string $code): array
    {
        $response = $this->client->post('/api/oauth.access', [
            \GuzzleHttp\RequestOptions::FORM_PARAMS => [
                'client_id' => config('services.slack.client_id'),//'96563862338.463662295171',
                'client_secret' => config('services.slack.client_secret'),//'b4d6b4e020a709ed8af024cc18656b62',
                'code' => $code,
                'redirect_uri' => route('login', [], true),
            ],
        ]);
        $responseRaw = $response->getBody()->getContents();
        $responseDecoded = json_decode($responseRaw, true);

        return $responseDecoded;
    }
}