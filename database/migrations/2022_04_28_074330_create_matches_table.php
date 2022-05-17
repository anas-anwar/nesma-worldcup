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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('start');
            $table->time('end');
            // $table->unsignedBigInteger('round_id');
            // $table->unsignedBigInteger('stadium_id');
            // $table->unsignedBigInteger('localteam_id');
            // $table->unsignedBigInteger('visitorteam_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
};
