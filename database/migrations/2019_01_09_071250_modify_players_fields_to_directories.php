<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Football\Player;

class ModifyPlayersFieldsToDirectories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn(['birthCountry', 'nationality', 'role']);
            $table->string('position', 15)->nullable()->change();
            $table->integer('nationalityId')->unsigned()->nullable();
            $table->integer('birthCountryId')->unsigned()->nullable();
            $table->foreign('nationalityId')
                ->references('id')
                ->on('locations')
                ->onDelete('set null');
            $table->foreign('birthCountryId')
                ->references('id')
                ->on('locations')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Player::whereNull('position')->delete();
        DB::statement("update teams set lastUpdated='2017-01-01 00:00:00'");
        Schema::table('players', function (Blueprint $table) {
            $table->dropForeign('players_nationalityid_foreign');
            $table->dropForeign('players_birthcountryid_foreign');
            $table->dropColumn(['nationalityId', 'birthCountryId']);
            $table->string('birthCountry', 30);
            $table->string('nationality', 30);
            $table->string('role');
            $table->string('position', 20)->nullable(false)->change();
        });
    }
}
