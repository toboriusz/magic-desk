<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('asset_type_id')->unsigned();
            $table->integer('site_id')->unsigned()->nullable();
            $table->integer('employee_id')->unsigned()->nullable();
            $table->integer('state_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('name');
            $table->string('barcode')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('asset_type_id')
                  ->references('id')
                  ->on('asset_types')
                  ->onDelete('cascade');
            
            $table->foreign('site_id')
                  ->references('id')
                  ->on('sites')
                  ->onDelete('set null');

            $table->foreign('employee_id')
                  ->references('id')
                  ->on('employees')
                  ->onDelete('set null');

            $table->foreign('state_id')
                  ->references('id')
                  ->on('states');

            $table->foreign('product_id')
                  ->references('id')
                  ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
