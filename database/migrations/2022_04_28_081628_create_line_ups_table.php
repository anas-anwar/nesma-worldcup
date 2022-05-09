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
        Schema::create('line_ups', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('match_id');
            // $table->unsignedBigInteger('team_id');
            // $table->unsignedBigInteger('player_id');
            $table->string('substitution');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('line_ups');
    }
};
