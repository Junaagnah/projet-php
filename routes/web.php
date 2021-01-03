<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// Routes that don't need any guard
// Index
Route::get('/', 'IndexController@default');

// Search
Route::get('/search', 'IndexController@search');

// User profile
Route::get('/user/{username}', 'UserController@showUserprofile');

// MovieOverwiew
Route::get('/movieOverview', 'MovieController@getOverview');

// Login
Route::get('/login', 'AuthController@login');

//Edit profile
Route::post('/edit-user-action/{username}', 'UserController@editUserAction');

// Unauthenticated routes group
Route::group(['middleware' => 'unauthenticated'], function () {
    // Login
    Route::get('/login', 'AuthController@login');

    // LoginAction
    Route::post('/login-action', 'AuthController@LoginAction');

    // Register
    Route::get('/register', 'AuthController@register');

    // Registration form
    Route::post('/register-action', 'AuthController@registerAction');
});

// Authenticated routes group
Route::group(['middleware' => 'authenticated'], function () {
    // DisconnectAction
    Route::get('/disconnect', 'AuthController@Disconnect');

    // Add review on movie overview
    Route::post('/addReview', 'ReviewController@addReview');

    // Edit review on movie overview
    Route::post('/editReview', 'ReviewController@editReview');

    // Delete review on movie overview
    Route::post('/deleteReview', 'ReviewController@deleteReview');

    // Admin routes group
    Route::group(['middleware' => 'admin'], function () {
        // Admin Page
        Route::get('/admin', 'AdminController@show');

        // Search user form
        Route::post('/search-user', 'AdminController@searchUser');

        //Ban user
        Route::post('/ban-user', 'AdminController@banUser');

        //Unban user
        Route::post('/unban-user', 'AdminController@unbanUser');

        //Promote user to moderator
        Route::post('/promote-moderator', 'AdminController@promoteUserToModerator');

        //Promote user to Admin
        Route::post('/promote-admin', 'AdminController@promoteUserToAdmin');

        //Demote user to classic user
        Route::post('/demote-user', 'AdminController@demoteUser');
    });
});
