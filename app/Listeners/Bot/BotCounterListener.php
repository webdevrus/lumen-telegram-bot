<?php

namespace App\Listeners\Bot;

use App\Actions\Bot\CounterAction;
use App\Events\Bot\BotCounter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BotCounterListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(BotCounter $event)
    {
        CounterAction::run();
    }
}
