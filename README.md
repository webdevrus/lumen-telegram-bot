# Lumen Telegram Bot

✅ Подходит для большинства серверов (PHP ≥ 7.3)

✅ Легко и быстро установить, запустить, настроить

✅ Всё необходимое от Laravel **Lumen** *(Eloquent ORM, DI Container, Migrations, Middlewares, Events, Queues...)*

## Установка

1. Склонируйте репозиторий
```console
git clone git@github.com:webdevrus/lumen-telegram-bot.git your_project
```
*`your_project` — название вашего проекта*

2. Настройте `.env`
```console
cp .env.example .env
```
*Не забудьте указать `BOT_TOKEN`*

3. Выполните миграции
```console
php artisan migrate
```

4. Вы великолепны 🥳

## Работа с ботом

> ⚠ Используется пакет [telegram-bot/api](https://github.com/TelegramBot/Api) для работы с Telegram Bot API

Все команды находятся в файле `/routes/commands.php`.

### Варианты объявления команд
1. Через функцию замыкания

```php
$bot->command('start', function (\TelegramBot\Api\Types\Message $message) use ($bot) {
    $bot->sendMessage($message->getChat()->getId(), 'Hello, world!');
});
```

2. Через класс `App\Telegram\Command`

Для примера у нас будет `StartCommand`.

В `/routes/commands.php`:
```php
$bot->command('command', function (\TelegramBot\Api\Types\Message $message) use ($bot) {
    return new \App\Commands\StartCommand($message, $bot);
});
```

* Создайте класс команды через `artisan` в консоли:

```console
php artisan bot:command StartCommand
```

* Или в `/app/Commands` создайте класс команды вручную:
```php
<?php

namespace App\Commands;

use App\Telegram\Command;

class StartCommand extends Command
{
    public function handle()
    {
        $this->bot->sendMessage(
            $this->message->getChat()->getId(),
            'Hello, world!'
        );
    }
}
```

### Установка webhook

Установить webhook можно несколькими способами.

1. Через `artisan` команду в консоли:
```console
php artisan bot:webhook --url={your_domain}/bot
```
`{your_domain}/bot` — URL адрес для установки webhook

2. Через главную страницу (для этого просто её откройте)

3. Вручную перейти по адресу `https://api.telegram.org/bot{BOT_TOKEN}/setWebhook?url={BOT_WEBHOOK_URL}`
> Не забудьте поменять `{BOT_TOKEN}` и `{BOT_WEBHOOK_URL}` на свои значения

## Разработка в локальном окружении

1. Установите [ngrok](https://ngrok.com/)
2. Запустите `ngrok`
```console
ngrok http --host-header={local_domain} 80
```
3. Перейдите по `forwarding` ссылке
4. Если всё сделано правильно, будет открыта главная страница и установлен webhook
5. Можно тестировать бота 🎉