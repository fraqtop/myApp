<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('roleId')->unsigned()->nullable();
            $table->integer('nationalityId')->unsigned()->nullable();
            $table->integer('birthCountryId')->unsigned()->nullable();
            $table->foreign('roleId')
                ->references('id')
                ->on('roles')
                ->onDelete('set null');
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
        Schema::table('players', function (Blueprint $table) {
            $table->dropForeign('players_roleid_foreign');
            $table->dropForeign('players_nationalityid_foreign');
            $table->dropForeign('players_birthcountryid_foreign');
            $table->dropColumn(['roleId', 'nationalityId', 'birthCountryId']);
            $table->string('birthCountry', 30);
            $table->string('nationality', 30);
            $table->string('role', 20);
        });
    }
}
