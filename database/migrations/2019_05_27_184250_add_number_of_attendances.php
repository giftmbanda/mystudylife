<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumberOfAttendances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Subject', function (Blueprint $table) {
            $table->integer('number_of_attendances')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Subject', function (Blueprint $table) {
            $table->dropColumn('number_of_attendances');
        });
    }
}
