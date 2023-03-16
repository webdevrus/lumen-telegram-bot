<?php

namespace App\Http\Controllers;

use App\Telegram\Bot;
use App\Events\Bot\BotCounter;

class MainController extends Controller
{
    public function index()
    {
        return redirect()->route('webhook');
    }

    public function webhook(Bot $bot): void
    {
        $bot->setWebhook(webhook_url());
    }

    public function bot(Bot $bot): void
    {
        $bot->run();

        event(new BotCounter);
    }
}
