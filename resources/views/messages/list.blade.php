<?php
/** @var \Illuminate\Database\Eloquent\Collection $messages */
?>
<ul>
    @foreach($messages as $message)
        <li>{{ $message->source->event['text'] }}</li>
    @endforeach
</ul>
