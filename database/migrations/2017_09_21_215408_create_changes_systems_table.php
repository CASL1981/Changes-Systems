<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChangesSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('changes_systems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 120)->nullable();
            $table->string('rs', 120)->nullable();
            $table->string('client', 120)->nullable();
            $table->string('permission', 30)->default('null');
            $table->string('module')->nullable();
            $table->string('detailpermission')->nullable();
            $table->boolean('other')->default(false);
            $table->string('which')->nullable();
            $table->text('justification')->nullable();
            $table->text('observation')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('solicitud_id')->unsigned();
            $table->integer('center_id')->unsigned();
            $table->integer('document_id')->unsigned();
            $table->integer('director')->unsigned()->default(0);
            $table->boolean('state')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('changes_systems');
    }
}
