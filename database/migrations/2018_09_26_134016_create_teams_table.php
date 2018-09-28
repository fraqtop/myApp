<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('name', 50);
            $table->string('shortName', 20);
            $table->string('logoURL');
            $table->char('tla', 3);
            $table->string('site',50);
            $table->smallInteger('founded')->unsigned();
            $table->string('colors', 30);
            $table->string('stadium',30);
            $table->dateTime('lastUpdated');
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
        Schema::dropIfExists('teams');
    }
}
