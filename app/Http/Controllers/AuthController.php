<?php

namespace App\Http\Controllers;

use App\Traits\SessionTrait;
use Exception;
use Illuminate\Http\RedirectResponse;
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
     * @return Exception|ValidationException|View
     */
    public function registerAction(Request $request)
    {
        $input = $request->all();

        $password = hash('sha256', $input['password']);

        try {
            $this->validate($request, [
                'username' => ['required', 'unique:users'],
                'firstName' => ['required'],
                'lastName' => ['required'],
                'title' => ['required'],
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

        // Once the user is registered, we connect him and redirect to index
        return $this->loginAction($request);
    }

    /**
     * @param Request $request
     * @return Exception|ValidationException|View|RedirectResponse
     */
    public function loginAction(Request $request)
    {
        // Hashing password
        $hashedPassword = hash('sha256', $request->get('password'));

        // Checking if fields are correct
        try {
            $this->validate($request, [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
        } catch (ValidationException $errors) {
            return view('errors', ['error' => $errors->getResponse()->getContent()]);
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
                return view('errors', ['error' => 'Vous avez été banni et ne pouvez plus vous connecter.']);
            }
        }
        else {
            return view('errors', ['error' => 'Adresse e-mail ou mot de passe incorrect.']);
        }
    }

    /**
     * @return RedirectResponse
     */
    public function disconnect(): RedirectResponse
    {
        SessionTrait::unsetSessionCookie();
        return redirect('/');
    }
}
