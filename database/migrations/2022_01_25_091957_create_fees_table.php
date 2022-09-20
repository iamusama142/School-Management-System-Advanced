<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id('fee_id');
            $table->integer('fee');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('student_id')->on('students');
            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')->references('parent_id')->on('parents');
            $table->integer('due_date');
            $table->integer('after_date');
            $table->string('date_created');
            $table->integer('total_fee');
            $table->string('paid');
            $table->string('remaining');
            $table->string('fee_status');
            $table->string('month');
            $table->string('day');
            $table->string('year');
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
        Schema::dropIfExists('fees');
    }
}