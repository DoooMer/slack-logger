<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Добавление таблицы каналов.
 */
class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->string('id')->nullable(false);
            $table->string('team_id')->nullable(false);
            $table->string('name')->nullable();
            $table->boolean('is_channel')->default(false);
            $table->boolean('is_group')->default(false);
            $table->boolean('is_im')->default(false);
            $table->boolean('is_archived')->default(false);
            $table->string('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channels');
    }
}
