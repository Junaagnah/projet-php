<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Traits\MoviesTrait;

class MovieController extends BaseController
{

    /**
     * @param Request $request
     * @return View
     */
    public function getOverview(Request $request)
    {
        $movieId = $request->input('movieId');
        $result = MoviesTrait::getMovieById($movieId);
        return View('movie-overview', ['movie' => $result['movie'], 'reviews' => $result['reviews']]);
    }
}
