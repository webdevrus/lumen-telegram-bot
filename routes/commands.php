<?php

/** @var \App\Telegram\Bot $bot */

use App\Commands\ExampleCommand;
use App\Handlers\MessageHandler;
use TelegramBot\Api\Types\Message;

$bot->command('start', function (Message $message) use ($bot) {
    $bot->sendMessage($message->getChat()->getId(), 'Hello, world!');
});

$bot->command('command', function (Message $message) use ($bot) {
    return new ExampleCommand($message, $bot);
});

$bot->message(MessageHandler::class);

// PHP ≥ 7.4
// $bot->command('command', fn (Message $message) => new ExampleCommand($message, $bot));
