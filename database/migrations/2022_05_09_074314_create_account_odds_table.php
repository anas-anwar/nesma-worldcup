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
        Schema::create('account_odds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('match_id');
            $table->foreign('match_id')->references('id')->on('matches')->cascadeOnDelete();
            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')->references('id')->on('accounts')->cascadeOnDelete();
            $table->unsignedBigInteger('vote');
            $table->foreign('vote')->references('id')->on('teams')->onDelete('set null')->cascadeOnDelete();
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
        Schema::dropIfExists('account_odds');
    }
};
