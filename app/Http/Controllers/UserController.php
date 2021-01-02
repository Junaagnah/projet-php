<?php

namespace App\Http\Controllers;

use App\Traits\SessionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\User;
use mysql_xdevapi\Exception;

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

    /**
     * @param Request $request
     * @return Exception|ValidationException|View
     */
    public function editUserAction(Request $request, string $username)
    {
        $input = $request->all();

        $user = User::where('username', $username)->first();

        $password = hash('sha256', $input['password_confirmation']);

        //Checked if user is user or admin
        //dd($user->getAuthPassword());
        //if ($user->getAuthPassword() === $hashedPassword)

        dump($input);
        //if ($SESSION[])
        $encryptedUsername = $request->cookie(COOKIE_SESSION_KEY);
        $userLoggedIn = SessionTrait::getSessionCookieValue($encryptedUsername);
        $currentUser = User::getOneUserByUsername($userLoggedIn);

        dump($currentUser['password']);
        dump($input['password_confirmation']);
        dump($password);
        if ($currentUser['password'] == $password && $currentUser['username'] == $input['username'] || $currentUser['userRole'] == "ROLE_ADMIN")
        {
            die();
        }

        if ($input['password'] !== null) {
            $password = hash('sha256', $input['password']);
            $input['password'] = $password;
        }

        if (isset($input['private']) && $input['private'] !== '')
        {
            $input['private'] = intval($input['private']);
        }

        if (isset($input['profile_picture']) && $input['profile_picture'] !== NULL)
        {
            $image_name = Str:: uuid() .'.'. $request->file('profile_picture')->getClientOriginalExtension();
            $request->file('profile_picture')->move('images/profile_picture', $image_name);
            $input['profilePicturePath'] = $image_name;

            /*try {
                $this->validate($request, [
                    'profile_picture' => 'image|max:32.896',

                ]);
            } catch (ValidationException $errors) {
                return view('errors', ['error' => $errors->getResponse()->getContent()]);
            }*/
        }

        foreach ($input as $key => $value) {
            if ($value === '')
            {
                unset($input[$key]);
            }
        }

        $user->update($input);

        // Once the user is registered, we connect him and redirect to index
        return View('profile', ['user' => $user]);
    }
}
