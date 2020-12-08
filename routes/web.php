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

// Index
Route::get('/', 'IndexController@default');

// Search
Route::get('/search', 'IndexController@search');

// Login
Route::get('/login', 'AuthController@login');

// LoginAction
Route::post('/login-action', 'AuthController@LoginAction');

// Register
Route::get('/register', 'AuthController@register');

// Registration form
Route::post('/register-action', 'AuthController@registerAction');

// DisconnectAction
Route::get('/disconnect', 'AuthController@Disconnect');

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
