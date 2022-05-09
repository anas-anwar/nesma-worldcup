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
        Schema::create('stadiums', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('description', 50);
            $table->integer('phone');
            $table->integer('capacity');
            $table->string('address', 50);
            $table->float('longtude');
            $table->float('lattude');
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
        Schema::dropIfExists('stadiums');
    }
};
