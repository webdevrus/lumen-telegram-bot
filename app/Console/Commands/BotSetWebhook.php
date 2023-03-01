<?php

namespace App\Console\Commands;

use App\Telegram\Bot;
use Illuminate\Console\Command;

class BotSetWebhook extends Command
{
    protected $signature = 'bot:webhook
                            {--url= : Webhook URL}';

    protected $description = 'Telegram Bot set webhook';

    public function handle(Bot $bot)
    {
        try {
            $url = $this->option('url');

            if ($url) {
                $bot->setWebhook($url);
                $this->info('Webhook has been set: ' . $url);
            } else {
                throw new \Exception('URL is empty');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
