<?php

namespace App\Jobs\SlackEvents;

class HandleMessage
{
    private $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function handle()
    {
        file_put_contents('/var/www/storage/logs/slack_job.log', json_encode($this->payload));
    }
}