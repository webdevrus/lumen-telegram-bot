<?php

namespace App\Actions\Bot;

use App\Models\Bot\User;
use Carbon\Carbon;
use TelegramBot\Api\Types\User as Form;

class UserAction
{
    public static function run(Form $form)
    {
        $date_at = Carbon::now()->format('Y-m-d');

        /** @var \App\Models\Bot\User $user */
        $user = User::query()
            ->firstOrCreate([
                'telegram_id'       => $form->getId(),
                'telegram_username' => $form->getUsername(),
            ], [
                'first_name'        => $form->getFirstName(),
                'last_name'         => $form->getLastName(),
                'is_bot'            => $form->isBot(),
                'language_code'     => $form->getLanguageCode(),
            ]);

        $user->statistic()
            ->firstOrCreate(['date_at' => $date_at])
            ->increment('count');
    }
}
