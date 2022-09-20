<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            $table->string('parent_id');
            $table->string('student_name');
            $table->unsignedBigInteger('program_id');
            $table->foreign('program_id')->references('program_id')->on('programs');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('class_id')->on('classes');
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('section_id')->on('sections');
            $table->unsignedBigInteger('roll_id');
            $table->foreign('roll_id')->references('roll_id')->on('roll');
            $table->string('dateofbirth')->nullable();
            $table->string('dateofadmission');
            $table->string('tuition_fee');
            $table->string('stationary_fee')->nullable();
            $table->string('admission_fee');
            $table->string('anual_fee')->nullable();
            $table->string('fine')->nullable();
            $table->string('Status')->nullable();
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
        Schema::dropIfExists('students');
    }
}