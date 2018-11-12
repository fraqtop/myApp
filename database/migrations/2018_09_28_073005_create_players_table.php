<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('name', 50);
            $table->string('position', 20);
            $table->date('birth');
            $table->string('birthCountry', 30);
            $table->string('nationality', 30);
            $table->string('role', 20);
            $table->integer('teamId')->unsigned();
            $table->primary('id');
            $table->foreign('teamId')
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
        Schema::dropIfExists('players');
    }
}
