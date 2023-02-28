<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\Bot\BotUser::class => [
            \App\Listeners\Bot\BotUserListener::class,
        ],
        \App\Events\Bot\BotCounter::class => [
            \App\Listeners\Bot\BotCounterListener::class,
        ],
    ];
}
