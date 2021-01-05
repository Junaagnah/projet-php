<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Traits\ReviewTrait;

class ReviewController extends BaseController
{

    /**
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function addReview(Request $request)
    {
        // Add a review, if addReview return a result it's an error View
        $errorView = ReviewTrait::addReview($request);
        if (!empty($errorView)) {
            return $errorView;
        }
        $input = $request->all();
        // Return the movie view
        return redirect('/movieOverview?movieId=' . $input['FK_movieId']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function editReview(Request $request)
    {
        // Edit a review, if editReview return a result it's an error View
        $errorView = ReviewTrait::editReview($request);
        if (!empty($errorView)) {
            return $errorView;
        }
        $input = $request->all();
        // Return the movie view
        return redirect('/movieOverview?movieId=' . $input['FK_movieId']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function deleteReview(Request $request)
    {
        // Delete a review, if deleteReview return a result it's an error View
        $errorView = ReviewTrait::deleteReview($request);
        if (!empty($errorView)) {
            return $errorView;
        }
        $input = $request->all();
        // Return the movie view
        return redirect('/movieOverview?movieId=' . $input['FK_movieId']);
    }
}
