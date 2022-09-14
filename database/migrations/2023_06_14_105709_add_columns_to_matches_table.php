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
            $table->dateTime('date_time')->nullable();
            $table->integer('minute')->default(90);
            $table->integer('second')->nullable();
            $table->integer('added_time')->nullable();
            $table->integer('extra_minute')->nullable();
            $table->integer('injury_time')->nullable();
            $table->integer('localteam_score')->default(0);
            $table->integer('visitorteam_score')->default(0);
            $table->integer('localteam_pen_score')->nullable();
            $table->integer('visitorteam_pen_score')->nullable();
            $table->string('ht_score')->nullable();
            $table->string('ft_score')->nullable();
            $table->string('et_score')->nullable();
            $table->string('ps_score')->nullable();
           
            $table->unsignedBigInteger('winner_team_id')->nullable();
            // $table->foreign('winner_team_id')->references('id')->on('teams')->cascadeOnDelete();     
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
            $table->dropColumn(['date_time', 'minute','second','added_time','extra_minute','injury_time','localteam_score','visitorteam_score',
                                 'localteam_pen_score','visitorteam_pen_score','ht_score', 'ft_score','et_score' ,'ps_score','winner_team_id' ]);
        });
    }
};
