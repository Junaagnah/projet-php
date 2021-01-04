<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Laravel\Lumen\Application;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\User;

class UserController extends BaseController {

    /**
     * @param Request $request
     * @param int $id
     * @return View
     */
    public function showUserProfile(Request $request, string $username): View
    {
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
     * @param string $username
     * @return ValidationException|View|string
     */
    public function editUserAction(Request $request, string $username)
    {
        $input = $request->all();

        $user = User::where('username', $username)->first();

        if (!empty($_SESSION['user']))
        {
            switch ($_SESSION['user']['userRole'])
            {
                case 'ROLE_ADMIN':
                    if ($_SESSION['user']['password'] !== hash('sha256', $input['password_confirmation']))
                    {
                        return View('errors', ['error' => "Votre mot de passe est incorrect"]);
                    }
                    break;

                case 'ROLE_USER':
                    if ($user['password'] !== hash('sha256', $input['password_confirmation']))
                    {
                        return View('errors', ['error' => "Votre mot de passe est incorrect"]);
                    }
                    if ($user['username'] !== $_SESSION['user']['username'])
                    {
                        return View('errors', ['error' => "Vous devez être le propriétaire du profil ou un utilisateur Admin pour pouvoir modifier le profil"]);
                    }
                    break;
            }
        } else {
            return View('errors', ['error' => "Vous devez être connecté(e) pour pouvoir modifier un profil"]);
        }

        foreach ($input as $key => $value) {
            if ($value === '')
            {
                unset($input[$key]);
            }
        }

        if (isset($input['profile_picture']) && $input['profile_picture'] !== NULL)
        {
            //Delete and set image name
            $input['profilePicturePath'] = $this->processFile($request->file('profile_picture'), $user);
            //Fix error Handling Todo: Improve
            if (gettype($input['profilePicturePath']) !== 'string')
            {
                return $input['profilePicturePath'];
            }
        }

        if (isset($input['private']) && $input['private'] !== '')
        {
            $input['private'] = intval($input['private']);
        }

        $user->update($input);

        return View('profile', ['user' => $user]);
    }

    /**
     * @param UploadedFile $file
     * @param User $user
     * @return string
     */
    public function processFile(UploadedFile $file, User $user)
    {
        $authorizedMimeType = [
            'image/jpg',
            'image/jpeg',
            'image/gif',
            'image/png',
            'image/svg'
        ];

        //Check file type with array
        if (in_array($file->getMimeType(), $authorizedMimeType)){

            //check if user already has a profile picture
            if (isset($user['profilePicturePath'])) {
                unlink('images/profile_picture/' . $user['profilePicturePath']);
            }
            $image_name = Str:: uuid() .'.'. $file->getClientOriginalExtension();
            $file->move('images/profile_picture', $image_name);

            return $image_name;
        } else {
            return View('errors', ['error' => 'The file is not valid']);
        }
    }
}
