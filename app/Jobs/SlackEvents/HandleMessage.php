<?php

namespace App\Jobs\SlackEvents;

use App\Message;
use App\MessageMeta;
use Illuminate\Support\Facades\Log;

class HandleMessage
{
    private $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function handle()
    {
        Log::debug("SlackEventMessageJob: \nrequested payload: \n" . json_encode($this->payload));

        // TODO: do saving message here
        Message::create($this->payload);
        MessageMeta::create([
            'id' => $this->payload['event']['client_msg_id'],
            'team_id' => $this->payload['team_id'],
            'user_id' => $this->payload['event']['user'],
            'event_id' => $this->payload['event_id'],
            'event_time' => $this->payload['event_time'],
            'type' => $this->payload['type'],
        ]);
    }
}