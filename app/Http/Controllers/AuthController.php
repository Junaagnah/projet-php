<?php

namespace App\Http\Controllers;

use App\Traits\SessionTrait;
use App\Traits\AuthTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    /**
     * @return View
     */
    public function login()
    {
        return view('login');
    }

    /**
     * @return View
     */
    public function register()
    {
        return view('register');
    }

    /**
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function registerAction(Request $request)
    {
        $result = AuthTrait::register($request);

        // If result is not empty we might have an error, so we return it
        if (!empty($result))
            return $result;

        // Once the user is registered, we connect him and redirect to index
        return $this->loginAction($request);
    }

    /**
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function loginAction(Request $request)
    {
        return AuthTrait::login($request);
    }

    /**
     * @return RedirectResponse
     */
    public function disconnect()
    {
        SessionTrait::unsetSessionCookie();
        return redirect('/');
    }
}
