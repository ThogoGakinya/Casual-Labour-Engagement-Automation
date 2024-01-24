<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBurferfloatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('burferfloats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('current_float');
            $table->integer('burfer_amount');
            $table->integer('new_float');
            $table->timestamps();
            $table->integer('refunded_amount');
            $table->string('refund_date');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('burferfloats');
    }
}
