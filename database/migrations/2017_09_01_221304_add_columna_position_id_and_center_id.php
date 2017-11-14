<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnaPositionIdAndCenterId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->integer('position_id')->unsigned()->after('role');
            $table->integer('center_id')->unsigned()->after('position_id');

            $table->foreign('position_id')->references('id')->on('positions');
            $table->foreign('center_id')->references('id')->on('centers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_position_id_foreign');
            $table->dropColumn('position_id');
            $table->dropForeign('users_center_id_foreign');
            $table->dropColumn('center_id');
        });
    }
}
