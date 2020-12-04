<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\User;

class AuthController extends BaseController
{
    public function login(): View
    {
        return view('login');
    }

    public function register(): View
    {
        return view('register');
    }

    public function registerAction(Request $request) :View
    {
        $input = $request->all();
        $password = app()->make('hash')->make($input['password']);
        //Define password as hashed password
        $input['password'] = $password;
        $user = New User($input);

        $user->save();
        return view('login');
    }
}
