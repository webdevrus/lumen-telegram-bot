<?php

namespace App\Http\Controllers;

use App\Telegram\Bot;
use Illuminate\Http\Request;
use App\Events\Bot\BotCounter;

class MainController extends Controller
{
    public function index(Request $request, Bot $bot): void
    {
        $url = env('BOT_WEBHOOK_URL', sprintf('%s://%s/bot', $request->server('HTTP_X_FORWARDED_PROTO'), $request->server('HTTP_X_FORWARDED_HOST')));

        $bot->setWebhook($url);
    }

    public function bot(Bot $bot): void
    {
        $bot->run();

        event(new BotCounter);
    }
}
