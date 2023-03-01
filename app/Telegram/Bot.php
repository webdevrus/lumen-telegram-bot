<?php

namespace App\Telegram;

use GuzzleHttp\Client;
use TelegramBot\Api\Client as BotClient;

/** @mixin \TelegramBot\Api\BotApi */
class Bot extends BotClient
{
    /** @var string */
    private $token;

    /** @var \GuzzleHttp\Client */
    private $client;

    /** @var string */
    private $setWebhookUrl = 'https://api.telegram.org/bot%s/setWebhook?url=%s';

    public function __construct($token, $trackerToken = null)
    {
        parent::__construct($token, $trackerToken);

        $this->token = $token;
        $this->client = new Client();
    }

    /**
     * Group commands
     * 
     * @param  callable $callback
     * @return \App\Telegram\Bot
     */
    public function commandGroup(callable $callback): self
    {
        $callback($this);

        return $this;
    }

    public function setWebhook(string $url)
    {
        $webhookUrl = sprintf($this->setWebhookUrl, $this->token, $url);

        $response = json_decode(
            $this->client->get($webhookUrl)->getBody()->getContents()
        );

        if (!$response->ok) {
            throw new \App\Telegram\Exceptions\WebhookNotSetException;
        }
    }
}
