<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Student_Course', function (Blueprint $table) {
            $table->increments('sc_id');

            $table->integer('u_id')->unsigned();
            $table->foreign('u_id')->references('u_id')->on('User');
            
            $table->integer('c_id')->unsigned();
            $table->foreign('c_id')->references('c_id')->on('Course');
            
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
        Schema::dropIfExists('Student_Course');
    }
}
