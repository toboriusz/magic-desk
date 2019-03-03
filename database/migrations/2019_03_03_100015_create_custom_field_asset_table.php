<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFieldAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_field_asset', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('custom_field_id')->unsigned();
            $table->integer('asset_id')->unsigned();
            $table->string('value')->nullable();

            $table->foreign('custom_field_id')
                  ->references('id')
                  ->on('custom_fields')
                  ->onDelete('cascade');

            $table->foreign('asset_id')
                  ->references('id')
                  ->on('assets')
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
        Schema::dropIfExists('custom_field_asset');
    }
}
