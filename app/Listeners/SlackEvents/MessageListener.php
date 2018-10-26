<?php

namespace App\Listeners\SlackEvents;

use Illuminate\Support\Facades\Log;

class MessageListener
{
    public function handle(array $payload)
    {
        Log::debug(implode(' ', array_map(function ($value, $key) { return [$key . ' => ' . $value]; }, $payload)));
    }
}