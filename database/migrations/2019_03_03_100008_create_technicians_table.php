<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechniciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technicians', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('site_id')->unsigned()->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_token')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('job_title')->nullable();
            $table->boolean('enabled')->default(true);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('site_id')
                  ->references('id')
                  ->on('sites')
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
        Schema::dropIfExists('technicians');
    }
}
