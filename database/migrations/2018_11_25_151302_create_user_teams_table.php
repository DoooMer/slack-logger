<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Добавление таблицы связи пользователя с командами.
 */
class CreateUserTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_teams', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('user_id', 255)->nullable(false);
            $table->string('team_id', 255)->nullable(false);
            $table->boolean('is_deleted')->default(false);
            $table->unique(['user_id', 'team_id'], 'UX_user_teams_user_id_team_id');
            $table->index('is_deleted', 'IX_user_teams_is_deleted');
            $table->primary('id', 'PK_user_teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_teams');
    }
}
