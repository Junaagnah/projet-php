<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Laravel\Lumen\Routing\Controller as BaseController;

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
}
