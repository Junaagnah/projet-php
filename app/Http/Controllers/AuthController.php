<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\User;

class AuthController extends BaseController
{
    /**
     * @return View
     */
    public function login(): View
    {
        return view('login');
    }

    /**
     * @return View
     */
    public function register(): View
    {
        return view('register');
    }

    /**
     * @param Request $request
     * @return \Exception|ValidationException|View
     */
    public function registerAction(Request $request)
    {
        $input = $request->all();

        $hasher = app()->make('hash');
        $password = $hasher->make($input['password']);

        try {
            $this->validate($request, [
                'username' => ['required', 'unique:users'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'same:password_confirmation']
            ]);
        } catch (ValidationException $errors) {
            return view('errors', ['error' => $errors->getResponse()->getContent()]);
        }

        //Define password as hashed password
        $input['password'] = $password;

        $user = New User($input);

        $user->save();
        return view('login');
    }
}
