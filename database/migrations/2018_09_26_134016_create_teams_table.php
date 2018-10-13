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
            $table->string('logoURL')->nullable();
            $table->char('tla', 3)->nullable();
            $table->string('site',50)->nullable();
            $table->char('founded', 4)->nullable();
            $table->string('colors', 30)->nullable();
            $table->string('stadium',30)->nullable();
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
