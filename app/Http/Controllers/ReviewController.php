<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Traits\MoviesTrait;
use Illuminate\Support\Facades\DB;
use App\Review;

class ReviewController extends BaseController
{

    use MoviesTrait;

    public function addReview(Request $request)
    {
        // Validate the request
        $error = $this->validateReview($request);

        if (!empty($error))
            return $error;

        // Get all inputs
        $input = $request->all();

        // Retrieve a comment of this user on this movie
        $userCommentOnThisMovie = DB::table('reviews')->where('FK_movieID', $input['FK_movieId'])->where('FK_userId', $_SESSION['user']['id'])->get();

        // Get the movie that the user try to rate, it will be used to redirect when the job is done
        $currentMovie = $this->getMovieById($input['FK_movieId']);

        // If the user already added a comment on this movie return the error view
        if (!empty($userCommentOnThisMovie[0])) {
            return view('errors', ['error' => 'Vous ne pouvez pas poster plus d\'une revue par film, il faut mettre a jour votre ancienne revue.']);
        }

        // Save the review
        $input['FK_userId'] = $_SESSION['user']['id'];
        $review = New Review($input);
        $review->save();

        // Return the movie view
        return redirect('/movieOverview?movieId=' . $input['FK_movieId']);
    }

    public function editReview(Request $request)
    {
        // Validate the request
        $error = $this->validateReview($request);

        if (!empty($error))
            return $error;

        // Get all inputs
        $input = $request->all();

        // Retrieve a comment of this user on this movie
        $userCommentOnThisMovie = json_decode(DB::table('reviews')->where('FK_movieID', $input['FK_movieId'])->where('FK_userId', $_SESSION['user']['id'])->get(), true);

        // Get the movie that the user try to rate, it will be used to redirect when the job is done
        $currentMovie = $this->getMovieById($input['FK_movieId']);

        // If the never added a comment on this movie return the movie view with an error
        if (empty($userCommentOnThisMovie[0])) {
            return view('errors', ['error' => 'Vous n\'avez pas poster de revue sur ce film, impossible de mettre à jour une revue inexistante.']);
        }

        // Update the review
        DB::table('reviews')->where('FK_movieID', $input['FK_movieId'])->where('FK_userId', $_SESSION['user']['id'])->update(['review' => $input['review'], 'note' => $input['note'], 'updated_at' => date('Y-m-d H:i:s')]);

        // Return the movie view
        return redirect('/movieOverview?movieId=' . $input['FK_movieId']);
    }

    public function deleteReview(Request $request)
    {
        // Get all inputs
        $input = $request->all();

        // Retrieve a comment of this user on this movie
        $userCommentOnThisMovie = json_decode(DB::table('reviews')->where('FK_movieID', $input['FK_movieId'])->where('FK_userId', $_SESSION['user']['id'])->get(), true);

        // Get the movie from where the user want to remove hisq review, it will be used to redirect when the job is done
        $currentMovie = $this->getMovieById($input['FK_movieId']);

        // If the never added a comment on this movie return the movie view with an error
        if (empty($userCommentOnThisMovie[0])) {
            return view('errors', ['error' => 'Vous n\'avez pas poster de revue sur ce film, impossible de supprimer une revue inexistante.']);
        }

        // Update the review
        DB::table('reviews')->where('FK_movieID', $input['FK_movieId'])->where('FK_userId', $_SESSION['user']['id'])->delete();

        // Return the movie view
        return redirect('/movieOverview?movieId=' . $input['FK_movieId']);
    }

    private function validateReview(Request $request) {
        try {
            $this->validate($request, [
                'FK_movieId' => ['required'],
                'review' => ['required'],
                'note' => ['required', 'integer']
            ]);
        } catch (ValidationException $errors) {
            return View('errors', ['error' => $errors->getResponse()->getContent()]);
        }
    }
}
