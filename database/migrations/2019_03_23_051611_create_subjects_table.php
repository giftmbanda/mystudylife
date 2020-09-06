<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Subject', function (Blueprint $table) {
            $table->increments('s_id');

            $table->string('name');
            $table->string('code');
            $table->integer('semester');

            $table->integer('v_id')->unsigned();
            $table->foreign('v_id')->references('v_id')->on('Venue');
            
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
        Schema::dropIfExists('Subject');
    }
}
