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
        Schema::table('matches', function (Blueprint $table) {
            $table->unsignedBigInteger('round_id');
            $table->foreign('round_id')->references('id')->on('round');
            $table->unsignedBigInteger('stadium_id');
            $table->foreign('stadium_id')->references('id')->on('stadiums');
            $table->unsignedBigInteger('localteam_id');
            $table->foreign('localteam_id')->references('id')->on('teams');
            $table->unsignedBigInteger('visitorteam_id');
            $table->foreign('visitorteam_id')->references('id')->on('teams');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->dropColumn('round_id');
            $table->dropColumn('stadium_id');
            $table->dropColumn('localteam_id');
            $table->dropColumn('visitorteam_id');
        });
    }
};
