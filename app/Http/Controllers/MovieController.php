<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Traits\MoviesTrait;
use Illuminate\Support\Facades\DB;
use App\Review;

class MovieController extends BaseController
{

    use MoviesTrait;

    public function getOverview(Request $request)
    {
        $movieId = $request->input('movieId');
        $result = $this->getMovieById($movieId);
        return view('movie-overview', ['movie' => $result['movie'], 'reviews' => $result['reviews']]);
    }
}
