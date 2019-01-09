<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyLeaguesLocationToForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leagues', function (Blueprint $table) {
            $table->dropColumn('logo');
            $table->integer('locationId')->unsigned()->nullable();
            $table->foreign('locationId')
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
        Schema::table('leagues', function (Blueprint $table) {
            $table->dropForeign('leagues_locationid_foreign');
            $table->dropColumn('locationId');
            $table->string('logo')->nullable();
        });
    }
}
