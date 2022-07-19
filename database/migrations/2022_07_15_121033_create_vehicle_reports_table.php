<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('site_id');
            $table->integer('vehicle_id');
            $table->tinyInteger('report_type');
            $table->integer('etc_value')->nullable();
            $table->string('etc_apply')->nullable();
            $table->integer('oil_value')->nullable();
            $table->string('oil_apply')->nullable();
            $table->integer('parking_value')->nullable();
            $table->string('parking_apply')->nullable();
            $table->integer('other_value')->nullable();
            $table->string('other_apply')->nullable();
            $table->date('report_date')->nullable();
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
        Schema::dropIfExists('vehicle_reports');
    }
}
