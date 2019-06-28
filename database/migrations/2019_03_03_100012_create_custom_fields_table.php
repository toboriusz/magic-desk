<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('asset_type_id')->unsigned();
            $table->integer('order')->unsigned()->default(0);
            $table->string('name');
            $table->string('shortcode');
            $table->string('type');
            $table->string('default_value')->nullable();
            $table->string('description')->nullable();
            $table->longText('options')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('asset_type_id')
                  ->references('id')
                  ->on('asset_types')
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
        Schema::dropIfExists('custom_fields');
    }
}
