<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_shifts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->dateTime('start_time')->nullable();
            $table->string('start_place')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->string('end_place')->nullable();
            $table->integer('site_id')->nullable();
            $table->tinyInteger('over')->default(0);
            $table->integer('over_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_shifts');
    }
}
