<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\User;

class UserController extends BaseController {

    /**
     * @param Request $request
     * @param int $id
     * @return View
     */
    public function showUserProfile(Request $request, string $username) {
        $user = User::getOneUserByUsername($username);

        //@TODO: récupérer les 5 ou 10 derniers commentaires de l'utilisateur

        if (!empty($user)) {
            return View('profile', ['user' => $user]);
        }
        else {
            return View('errors', ['error' => 'L\'utilisateur n\'existe pas.']);
        }
    }
}
