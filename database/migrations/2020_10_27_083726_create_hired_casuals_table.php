<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHiredCasualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hired_casuals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('token_id');
            $table->integer('user_id');
            $table->integer('nssf');
            $table->integer('nhif');
            $table->integer('tax');
            $table->integer('total_deductions');
            $table->integer('gross_pay');
            $table->integer('net_pay');
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
        Schema::dropIfExists('hired_casuals');
    }
}
