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
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('match_id');
            $table->foreign('match_id')->references('id')->on('matches')->cascadeOnDelete();
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->cascadeOnDelete();
            $table->unsignedBigInteger('player_id');
            $table->foreign('player_id')->references('id')->on('players')->cascadeOnDelete();
            $table->unsignedBigInteger('type_of_events_id');
            $table->foreign('type_of_events_id')->references('id')->on('type_of_events')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('match_id');
            $table->dropColumn('team_id');
            $table->dropColumn('player_id');
            $table->dropColumn('type_of_events_id');
            
        });
    }
};
