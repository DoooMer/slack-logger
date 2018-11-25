<?php

namespace App\Services;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

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
     * @param string|null $cursor
     * @return array 0 - список каналов, 1 - курсор на следующую страницу
     */
    public function getChannelsByTeam(string $token, string $types = 'public_channel,private_channel,mpim,im', ?string $cursor = null)
    {
        $response = $this->client->get('/api/conversations.list', [
            \GuzzleHttp\RequestOptions::QUERY => compact('token', 'types', 'cursor'),
        ]);
        $responseDecoded = $this->decodeResponse($response);

        return [$responseDecoded['channels'], $responseDecoded['response_metadata']['next_cursor']];
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
        $responseDecoded = $this->decodeResponse($response);

        return $responseDecoded;
    }

    /**
     * Преобразует ответ в массив.
     *
     * @param ResponseInterface $response
     * @return array
     */
    private function decodeResponse(ResponseInterface $response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}