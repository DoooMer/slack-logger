<?php

namespace App\Listeners\SlackEvents;

class MessageListener
{
    // принимает параметры из массива payload, а не массив payload как написано в документации
    public function handle(...$args)
    {
        // do nothing
        // jobs are practically
    }
}