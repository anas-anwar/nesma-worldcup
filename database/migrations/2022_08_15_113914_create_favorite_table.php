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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained();
            // $table->foreignId('model_id')->constrained();
            $table->string('favoritable_type');
            $table->bigInteger('favoritable_id')->unsigned();
            $table->timestamps();
        });
        Schema::create('favoritables', function (Blueprint $table) {
            $table->bigInteger('favorite_id');
            $table->string('favoritable_type');
            $table->bigInteger('favoritable_id')->unsigned();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('favoritables');
    }
};
