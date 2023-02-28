<?php

namespace App\Models\Bot\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Statistic extends Model
{
    protected $table = 'bot_users_statistics';

    protected $fillable = [
        'user_id', 'date_at', 'count',
    ];

    protected $casts = [
        'date_at' => 'date',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(\App\Models\Bot\User::class, 'id', 'bot_user_id');
    }
}
