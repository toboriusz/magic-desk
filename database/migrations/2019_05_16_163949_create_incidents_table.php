<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asset_id')->unsigned();
            $table->integer('incident_type_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('body');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('asset_id')
                  ->references('id')
                  ->on('assets')
                  ->onDelete('cascade');

            $table->foreign('incident_type_id')
                  ->references('id')
                  ->on('incident_types')
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
        Schema::dropIfExists('incidents');
    }
}
