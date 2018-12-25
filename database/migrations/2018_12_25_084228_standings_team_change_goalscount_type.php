<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StandingsTeamChangeGoalscountType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('standings_team', function (Blueprint $table) {
            $table->smallInteger('goalsFor')->change();
            $table->smallInteger('goalsAgainst')->change();
            $table->dropColumn('position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('standings_team', function (Blueprint $table) {
            DB::statement(
                'alter table standings_team 
                        modify column goalsFor tinyint(3) unsigned,
                        modify column goalsAgainst tinyint(3) unsigned'
            );
            $table->tinyInteger('position')
                ->after('team_id')
                ->unsigned();
        });
    }
}
