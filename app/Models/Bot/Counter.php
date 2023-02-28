<?php

namespace App\Models\Bot;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    public $timestamps = false;

    protected $table = 'bot_counters';

    protected $fillable = [
        'date_at', 'count',
    ];

    protected $casts = [
        'date_at' => 'date:d.m.Y',
    ];
}
