<?php

namespace App\Commands;

use App\Telegram\Command;

class ExampleCommand extends Command
{
    public function handle()
    {
        $this->bot->sendMessage(
            $this->message->getChat()->getId(),
            $this->getMessage(),
            'markdown'
        );
    }

    private function getMessage(): string
    {
        return 'Hello! I\'m from `'.__CLASS__.'`';
    }
}
