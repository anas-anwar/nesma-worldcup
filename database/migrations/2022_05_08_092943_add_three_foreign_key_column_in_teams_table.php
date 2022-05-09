<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->unsignedBigInteger('player_id');
            $table->foreign('player_id')->references('id')->on('players');
            $table->unsignedBigInteger('stadium_id');
            $table->foreign('stadium_id')->references('id')->on('stadiums');
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('player_id');
            $table->dropColumn('stadium_id');
            $table->dropColumn('group_id');
        });
    }
};
