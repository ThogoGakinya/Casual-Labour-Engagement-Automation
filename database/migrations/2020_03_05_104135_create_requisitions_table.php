<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('token_id');
            $table->integer('user_id');
            $table->integer('department_id');
            $table->integer('budget_id');
            $table->integer('budget_approval_status');
            $table->string('budget_approval_date');
            $table->integer('hod_id');
            $table->integer('hod_approver_id');
            $table->string('hod_approval_date');
            $table->string('hod_approval_status');
            $table->integer('amount');
            $table->longText('description');
            $table->string('request_date');
            $table->integer('process_status');
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
        Schema::dropIfExists('requisitions');
    }
}
