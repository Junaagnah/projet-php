<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Laravel\Lumen\Routing\Controller as BaseController;

trait UserTrait {

    /**
     * @param string $username
     * @return View|RedirectResponse
     */
    public static function showUserProfile(string $username): View {
        $user = User::getOneUserByUsername($username);

        if (!empty($user)) {
            $reviews = UserTrait::getLastUserReviews($user['id']);

            // Getting the movies images if there is movies
            if (!empty($reviews)) {
                foreach($reviews as &$review) {
                    $movie = MoviesTrait::getMovieById($review['FK_movieId']);
                    $review['poster_path'] = $movie['movie']['poster_path'];
                }
            }

            return View('profile', ['user' => $user, 'reviews' => $reviews]);
        }
        else {
            return View('errors', ['error' => 'L\'utilisateur n\'existe pas.']);
        }
    }

    public static function editUserAction(Request $request, string $username) {
        $input = $request->all();
        $baseController = new BaseController();

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

        try {
            $baseController->validate($request,[
                'username' => 'alpha_num',
            ]);
        } catch (ValidationException $errors) {
            return View('errors', ['error' => "Le champ 'Pseudo' ne doit pas contenir de caractères spéciaux"]);
        }

        if (isset($input['profile_picture']) && $input['profile_picture'] !== NULL)
        {
            //Delete and set image name
            $input['profilePicturePath'] = UserTrait::processFile($request->file('profile_picture'), $user);
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

        if (isset($input['username'])) {
            $username = $input['username'];
            SessionTrait::unsetSessionCookie();
            SessionTrait::setSessionCookie($username);
        }

        return redirect('/user/' . $username);
    }

    /**
     * @param UploadedFile $file
     * @param User $user
     * @return View|string
     */
    private static function processFile(UploadedFile $file, User $user) {
        $authorizedMimeType = [
            'image/jpg',
            'image/jpeg',
            'image/png',
            'image/svg'
        ];

        //Check file type with array
        if (in_array($file->getMimeType(), $authorizedMimeType)) {

            //check if user already has a profile picture
            if (isset($user['profilePicturePath'])) {
                try {
                    unlink('images/profile_picture/' . $user['profilePicturePath']);
                } catch (\Throwable $th) {
                }
            }
            $image_name = Str:: uuid() . '.' . $file->getClientOriginalExtension();
            $file->move('images/profile_picture', $image_name);

            return $image_name;
        } else {
            return View('errors', ['error' => 'Le fichier n\'est pas valide.']);
        }
    }

    /**
     * @param int $userId
     * @return Array
     */
    private static function getLastUserReviews(int $userId) {
        $reviews = DB::table('reviews')->select('*')->where('FK_userId', $userId)->orderByDesc('updated_at')->get();

        return json_decode($reviews, true);
    }
}
