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
            $table->id();
            $table->unsignedBigInteger('user_status_id');
            $table->foreign('user_status_id')->references('id')->on('user_statuses')->onDelete('cascade');
            $table->unsignedBigInteger('user_role_id');
            $table->foreign('user_role_id')->references('id')->on('user_roles')->onDelete('cascade');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password');
            $table->string('image_path')->nullable();
            $table->text('Bio');
            $table->string('city');
            $table->date('joining_date');
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
