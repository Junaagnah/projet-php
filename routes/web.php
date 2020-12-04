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

// Login
Route::get('/login', 'AuthController@login');

// LoginAction
Route::post('/login-action', 'AuthController@LoginAction');

// Register
Route::get('/register', 'AuthController@Register');

// RegisterAction
Route::post('/register-action', 'AuthController@RegisterAction');

// DisconnectAction
Route::get('/disconnect', 'AuthController@Disconnect');
