<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stage', 20);
            $table->string('type', 20);
            $table->string('group', 20)->nullable();
            $table->integer('league_id')->unsigned();
            $table->unique(['stage', 'type', 'group', 'league_id']);
            $table->foreign('league_id')
                ->references('id')
                ->on('leagues')
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
        Schema::dropIfExists('standings');
    }
}
