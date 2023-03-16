<?php

namespace App\Telegram\Exceptions;

class MessageHandlerNotFoundException extends \Exception
{
    public function __construct(string $class)
    {
        $this->message = "Message handler class {$class} not found";
    }
}
