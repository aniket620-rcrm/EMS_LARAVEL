<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('users_id')->references('id')->on('users');
            $table->foreignId('user_statuses_id')->references('id')->on('user_statuses');
            $table->foreignId('roles_id')->references('id')->on('roles');
            $table->boolean('paid_status');
            $table->integer('leave_count');
            $table->integer('tax');
            $table->integer('deductions');
            $table->integer('payable_salary');
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
        Schema::dropIfExists('salaries');
    }
}
