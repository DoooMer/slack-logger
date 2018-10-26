<?php

namespace App\Listeners\SlackEvents;

class MessageListener
{
    public function handle($token, $teamId, $apiAppId, $event, ...$args)
    {
        file_put_contents('/var/www/storage/logs/slack.log', json_encode($event));
    }
}