<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTeamsStadiumLength extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->string('stadium', 70)
                ->nullable()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("update teams set stadium='loo large' where length(stadium) > 30");
        Schema::table('teams', function (Blueprint $table) {
            $table->string('stadium', 30)
                ->nullable()
                ->change();
        });
    }
}
