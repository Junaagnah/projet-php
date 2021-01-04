<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;

class addUserInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstName')->nullable(true);
            $table->string('lastName')->nullable(true);
            $table->string('title')->nullable(true);
            $table->boolean('private')->default(true);
        });

        // Adding admin user
        $userInput = [
            'username' => 'Administrator',
            'email' => 'admin@moviesplaceholder.com',
            'password' => hash('sha256', 'Password123*'),
            'userRole' => ROLE_ADMIN,
            'firstName' => 'Admin',
            'lastName' => 'Admin',
            'title' => 'Monsieur',
            'private' => 1
        ];

        $user = new User($userInput);
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
