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
        Schema::create('User', function (Blueprint $table) {
            $table->increments('u_id');
            
            $table->string('first_name');
            $table->string('last_name');

            $table->string('email')->unique()->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('user_type')->nullable();
            $table->string('id_number')->nullable();
            $table->string('password');
            
            $table->rememberToken();
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('User');
    }
}
