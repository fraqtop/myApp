<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Football\{League, Standings};

class AddStandingsSeasonStartDate extends Migration
{
    private $initialStartDate = '1970-01-01';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('standings', function (Blueprint $table) {
            $table->date('seasonStart')->default($this->initialStartDate);
            $table->index('seasonStart', 'season-start_i');
        });
        $leagues = Football::getLeagues(['plan' => 'TIER_ONE']);
        $leagues->each(function ($APILeague) {
            if ($DBLeague = League::find($APILeague->id)) {
                $DBLeague->standings->each(function (Standings $table) use($APILeague) {
                    $table->update([
                        'seasonStart' => $APILeague->currentSeason->startDate
                    ]);
                });
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('standings', function (Blueprint $table) {
            $table->dropIndex('season-start_i');
            $table->dropColumn('seasonStart');
        });
    }
}
