<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('referee', 30);
            $table->dateTime('startAt');
            $table->dateTime('lastUpdated');
            $table->tinyInteger('thrillRating')
                ->unsigned()
                ->nullable();
            $table->integer('homeId')->unsigned();
            $table->integer('awayId')->unsigned();
            $table->integer('leagueId')->unsigned();
            $table->primary('id');
            $table->foreign('homeId')
                ->references('id')
                ->on('teams');
            $table->foreign('awayId')
                ->references('id')
                ->on('teams');
            $table->foreign('leagueId')
                ->references('id')
                ->on('leagues');
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
}
