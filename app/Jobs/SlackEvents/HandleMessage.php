<?php

namespace App\Jobs\SlackEvents;

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

    }
}