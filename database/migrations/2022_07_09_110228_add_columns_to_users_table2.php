<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->integer('move_value')->nullable();
            $table->integer('guarantee_day')->nullable();
            $table->tinyInteger('vehicle_license')->default(0);
            $table->tinyInteger('heavy_license')->default(0);
            $table->integer('helmet')->nullable();
            $table->integer('daily_amount')->nullable();
            $table->integer('overtime_amount')->nullable();
            $table->integer('night_amount')->nullable();
            $table->integer('overnight_amount')->nullable();
            $table->integer('full_salary')->nullable();
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
            //
        });
    }
}
