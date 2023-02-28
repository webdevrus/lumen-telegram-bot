<?php

namespace App\Actions\Bot;

use App\Models\Bot\Counter;
use Carbon\Carbon;

class CounterAction
{
    public static function run()
    {
        $date_at = Carbon::now()->format('Y-m-d');

        Counter::query()
            ->where('date_at', $date_at)
            ->firstOrCreate(['date_at' => $date_at])
            ->where('date_at', $date_at)
            ->increment('count');
    }
}
