<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuelRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_requisitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('vehicle_id');
            $table->integer('previous_mileage');
            $table->integer('current_mileage');
            $table->integer('litres_requested');
            $table->integer('approver_1');
            $table->integer('approver_1_status');
            $table->integer('approver_1_date');
            $table->integer('approver_2');
            $table->integer('approver_2_status');
            $table->integer('approver_2_date');
            $table->integer('progress');
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
        Schema::dropIfExists('fuel_requisitions');
    }
}
