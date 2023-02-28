<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotCountersTable extends Migration
{
    public function up()
    {
        Schema::create('bot_counters', function (Blueprint $table) {
            $table->date('date_at');
            $table->integer('count')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('bot_counters');
    }
}
