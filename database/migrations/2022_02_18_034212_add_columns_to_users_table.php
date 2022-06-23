<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
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
            $table->string('furi')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->tinyInteger('blood')->nullable();
            $table->date('birthday')->nullable();
            $table->string('phone')->nullable();
            $table->string('emergency_name')->nullable();
            $table->string('emergency_number')->nullable();
            $table->tinyInteger('contract_type')->nullable();
            $table->integer('contract_value')->nullable();
            $table->integer('director_id')->nullable();
            $table->integer('office_id')->nullable();
            $table->integer('team_id')->nullable();
            $table->tinyInteger('dormitory')->nullable();
            $table->tinyInteger('cloth')->nullable();
            $table->tinyInteger('business_phone')->nullable();
            $table->tinyInteger('insurance')->nullable();
            $table->decimal('insurance_cost', 6, 2)->nullable();
            $table->decimal('safe_cost', 6, 2)->nullable();
            $table->tinyInteger('receive_type')->nullable();
            $table->integer('loan')->nullable();
            $table->integer('advance_pay')->nullable();
            $table->date('desire_start')->nullable();
            $table->string('desire_meet')->nullable();
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
