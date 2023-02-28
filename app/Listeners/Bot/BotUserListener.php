<?php

namespace App\Listeners\Bot;

use App\Actions\Bot\UserAction;
use App\Events\Bot\BotUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BotUserListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(BotUser $event)
    {
        UserAction::run($event->message->getFrom());
    }
}
