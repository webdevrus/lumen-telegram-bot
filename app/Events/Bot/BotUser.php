<?php

namespace App\Events\Bot;

use App\Events\Event;
use TelegramBot\Api\Types\Message;

class BotUser extends Event
{
    /** @var \TelegramBot\Api\Types\Message */
    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }
}
