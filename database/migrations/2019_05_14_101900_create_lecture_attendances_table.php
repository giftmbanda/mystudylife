<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLectureAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Lecture_Attendance', function (Blueprint $table) {
            $table->increments('sa_id');
            $table->timestamp('checkin_time')->useCurrent();
            $table->timestamp('checkout_time')->nullable();

            $table->integer('u_id')->unsigned();
            $table->foreign('u_id')->references('u_id')->on('User');
            
            $table->integer('s_id')->unsigned();
            $table->foreign('s_id')->references('s_id')->on('Subject');

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
        Schema::dropIfExists('Lecture_Attendance');
    }
}
