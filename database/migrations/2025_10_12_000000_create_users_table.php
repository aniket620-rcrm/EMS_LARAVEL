<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('phoneNumber');
            $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('roles_id');
            $table->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade');
            $table->unsignedBigInteger('user_statuses_id');
            $table->foreign('user_statuses_id')->references('id')->on('user_statuses')->onDelete('cascade');
            $table->unsignedBigInteger('salary_history_id');
            $table->foreign('salary_history_id')->references('id')->on('salary_histories')->onDelete('cascade');
            $table->unsignedBigInteger('salary_id');
            $table->foreign('salary_id')->references('id')->on('salaries')->onDelete('cascade');
            $table->unsignedBigInteger('leave_id');
            $table->foreign('leave_id')->references('id')->on('leaves')->onDelete('cascade');
            $table->unsignedBigInteger('leave_count_id');
            $table->foreign('leave_count_id')->references('id')->on('total_leaves')->onDelete('cascade');
            $table->date('joining_date');
            // $table->file('image')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
