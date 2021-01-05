<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

trait AuthTrait {

    /**
     * @param Request $request
     * @return Void | View
     */
    public static function register(Request $request) {
        $input = $request->all();
        $baseController = new BaseController();

        $password = hash('sha256', $input['password']);

        try {
            $baseController->validate($request, [
                'username' => ['required', 'unique:users', 'alpha_num'],
                'firstName' => ['required'],
                'lastName' => ['required'],
                'title' => ['required'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'same:password_confirmation']
            ]);
        } catch (ValidationException $errors) {
            return View('errors', ['error' => $errors->getResponse()->getContent()]);
        }

        //Define password as hashed password
        $input['password'] = $password;

        $user = New User($input);

        $user->save();
    }

    /**
     * @param Request $request
     * @return RedirectResponse|View
     */
    public static function login(Request $request) {
        // Hashing password
        $hashedPassword = hash('sha256', $request->get('password'));
        $baseController = new BaseController();

        // Checking if fields are correct
        try {
            $baseController->validate($request, [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
        } catch (ValidationException $errors) {
            return View('errors', ['error' => $errors->getResponse()->getContent()]);
        }

        // Trying to authenticate user
        $user = User::getOneUserByEmail($request->get('email'));
        if (!empty($user) && $user->getAuthPassword() === $hashedPassword) {
            // Checking if the user is banned
            if (!$user->getAttribute('isBanned')) {
                // Setting cookies and redirect to home page
                SessionTrait::setSessionCookie($user->getAttributeValue('username'));
                return redirect('/');
            }
            else {
                return View('errors', ['error' => 'Vous avez été banni et ne pouvez plus vous connecter.']);
            }
        }
        else {
            return View('errors', ['error' => 'Adresse e-mail ou mot de passe incorrect.']);
        }
    }
}
