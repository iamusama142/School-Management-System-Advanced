<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatesheetDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datesheet__details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('datesheet_id');
            $table->foreign('datesheet_id')->references('id')->on('datesheets');
            $table->date('date');
            $table->string('day');
            $table->string('time_start');
            $table->string('time_end');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('subject_id')->on('subjects');
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
        Schema::dropIfExists('datesheet__details');
    }
}
