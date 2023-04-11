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
            // $table->unsignedBigInteger('users_id');
            // $table->foreign('users_id')->references('id')->on('users');
            // $table->unsignedBigInteger('total_leaves_id');
            // $table->foreignId('total_leaves__id')->references('id')->on('total_leaves');
            // $table->unsignedBigInteger('user_statuses_id');
            // $table->foreignId('user_statuses_id')->references('id')->on('user_statuses');
            // $table->unsignedBigInteger('users_id');
            // $table->foreignId('roles_id')->references('id')->on('roles');
            // $table->integer('leave_count');
            $table->integer('payable_salary');
            $table->boolean('paid_status');
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
