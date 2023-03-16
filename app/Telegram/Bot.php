<?php

namespace App\Telegram;

use App\Telegram\Exceptions\BadResponseException;
use GuzzleHttp\Client;
use TelegramBot\Api\Types\Update;
use TelegramBot\Api\Client as BotClient;
use GuzzleHttp\Exception\ClientException;
use App\Telegram\Exceptions\WebhookNotSetException;
use App\Telegram\Exceptions\MessageHandlerNotFoundException;

/** @mixin \TelegramBot\Api\BotApi */
class Bot extends BotClient
{
    /** @var string */
    private $token;

    /** @var \GuzzleHttp\Client */
    private $client;

    /** @var string */
    private $setWebhookUrl = 'https://api.telegram.org/bot%s/setWebhook?url=%s';

    public function __construct(string $token, ?string $trackerToken = null)
    {
        parent::__construct($token, $trackerToken);

        $this->token = $token;
        $this->client = new Client();
    }

    /**
     * Group commands
     * 
     * @param  callable $callback
     * @return this
     */
    public function commandGroup(callable $callback): self
    {
        $callback($this);

        return $this;
    }

    /**
     * Set webhook URL
     * 
     * @param  string $url
     * @return void
     */
    public function setWebhook(string $url)
    {
        $webhookUrl = sprintf($this->setWebhookUrl, $this->token, $url);

        try {
            $this->getResponse($webhookUrl);
        } catch (\Exception $e) {
            if ($e instanceof ClientException) {
                $response = json_decode($e->getResponse()->getBody()->getContents());

                throw new WebhookNotSetException($response->description, $response->error_code);
            } else {
                throw new WebhookNotSetException;
            }
        }
    }

    /**
     * Message handler
     * 
     * @param  string $class
     * @return void
     */
    public function message(string $class)
    {
        if (!class_exists($class)) {
            throw new MessageHandlerNotFoundException($class);
        }

        $this->on(function (Update $update) use ($class) {
            return new $class($update->getMessage(), $this);
        }, function () {
            return true;
        });
    }

    private function getResponse(string $url): object
    {
        $response = json_decode($this->client->get($url)->getBody()->getContents());

        if (!$response->ok) {
            throw new BadResponseException($response->description, $response->error_code);
        }

        return $response;
    }
}
