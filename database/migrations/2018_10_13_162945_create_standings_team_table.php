<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandingsTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standings_team', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('standings_id')->unsigned();
            $table->integer('team_id')->unsigned();
            $table->decimal('position', 2, 0);
            $table->tinyInteger('points');
            $table->tinyInteger('won')->unsigned();
            $table->tinyInteger('draw')->unsigned();
            $table->tinyInteger('lost')->unsigned();
            $table->tinyInteger('goalsFor')->unsigned();
            $table->tinyInteger('goalsAgainst')->unsigned();
            $table->foreign('standings_id')
                ->references('id')
                ->on('standings')
                ->onDelete('cascade');
            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('standings_team');
    }
}
