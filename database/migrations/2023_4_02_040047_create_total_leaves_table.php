<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_leaves', function (Blueprint $table) {
            $table->id()->autoIncrement();
            // $table->unsignedBigInteger('users_id');
            // $table->foreign('users_id')->references('id')->on('users');
            $table->integer('month');
            $table->integer('leave_count');
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
        Schema::dropIfExists('total_leaves');
    }
}
