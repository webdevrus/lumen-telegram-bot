<?php

namespace App\Telegram;

use App\Telegram\Bot;
use App\Events\Bot\BotUser;
use TelegramBot\Api\Types\Message;

abstract class Command
{
    /** @var \App\Telegram\Bot */
    protected $bot;

    /** @var \TelegramBot\Api\Types\Message */
    protected $message;

    public function __construct(Message $message, Bot $bot)
    {
        $this->bot = $bot;
        $this->message = $message;

        $this->handle();
    }

    protected function dispatchEvents()
    {
        event(new BotUser($this->message));
    }

    abstract public function handle();
}
