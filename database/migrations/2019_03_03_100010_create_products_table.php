<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('asset_type_id')->unsigned();
            $table->string('brand');
            $table->string('model');
            $table->string('part_no')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('products');
    }
}
