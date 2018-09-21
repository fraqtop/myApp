<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('name', 50);
            $table->string('areaName', 20);
            $table->dateTime('startDate');
            $table->dateTime('endDate');
            $table->dateTime('lastUpdated');
            $table->smallInteger('matchday');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leagues');
    }
}
