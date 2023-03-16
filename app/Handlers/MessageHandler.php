<?php

namespace App\Handlers;

use App\Telegram\Handler;
use Illuminate\Support\Str;

class MessageHandler extends Handler
{
    public function handle()
    {
        $this->bot->sendMessage(
            $this->message->getChat()->getId(),
            $this->getMessage($this->message->getText()),
            'markdown'
        );
    }

    private function getMessage(string $text): string
    {
        $messages = [
            'hello' => 'Hello 👋',
            'hi' => 'Hi 👋',
        ];

        foreach ($messages as $message => $answer) {
            if (Str::of($text)->lower()->contains($message)) {
                return $answer;
            }
        }

        return "Hi 👋 \n\n I'm Bot 🤖";
    }
}
