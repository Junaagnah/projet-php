<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersAndReviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('email');
            $table->string('password');
            $table->string('username');
            $table->string('profilePicturePath')->nullable(true);
            $table->string('userRole')->default('ROLE_USER');
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('FK_userId')->unsigned();
            $table->string('FK_movieId');
            $table->string('review', 5000);
            $table->integer('note');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('FK_userId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('reviews');
    }
}
