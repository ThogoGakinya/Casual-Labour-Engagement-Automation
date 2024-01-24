<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucherbooks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('token');
            $table->string('name');
            $table->integer('status');
            $table->integer('opening_balance');
            $table->integer('expense');
            $table->integer('actual_balance');
            $table->string('open_date');
            $table->string('close_date');
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
        Schema::dropIfExists('voucherbooks');
    }
}
