<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAndReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('email');
            $table->string('password');
            $table->string('username');
            $table->string('profilePicturePath');
            $table->string('userRole');
        });

        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('FK_userId')->unsigned();
            $table->string('FK_movieId');
            $table->string('review');
            $table->integer('note');
        });

        Schema::table('review', function (Blueprint $table) {
            $table->foreign('FK_userId')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('review');
    }
}
