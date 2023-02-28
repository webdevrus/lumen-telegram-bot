<?php

namespace App\Providers;

use App\Telegram\Bot;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Bot::class, function () {
            return (new Bot(env('BOT_TOKEN')))->commandGroup(function (Bot $bot) {
                require base_path('routes/commands.php');
            });
        });
    }
}
