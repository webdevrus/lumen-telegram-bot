<?php

namespace App\Models\Bot;

use App\Models\Bot\User\Statistic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $table = 'bot_users';

    protected $fillable = [
        'first_name', 'last_name', 'telegram_id', 'telegram_username',
    ];

    public function statistic(): HasMany
    {
        return $this->hasMany(Statistic::class, 'bot_user_id', 'id');
    }
}
