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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->integer('phone');
            $table->string('rate', 50);
            $table->timestamps('hour_open');
            $table->timestamps('hour_close');
            $table->float('lattude');
            $table->float('longtude');
            $table->string('address', 50);
            // $table->unsignedBigInteger('services_id');
            // $table->unsignedBigInteger('images_id');
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
        Schema::dropIfExists('restaurants');
    }
};
