<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function getNowPlayingMovies(): array
    {
        return json_decode(file_get_contents('https://api.themoviedb.org/3/movie/now_playing?api_key='.MOVIE_DB_API_KEY.'&language=fr-FR&page=1'), true);
    }

    public function getMovie($id): array
    {
        return json_decode(file_get_contents('https://api.themoviedb.org/3/movie/'.$id.'?api_key='.MOVIE_DB_API_KEY.'&language=fr-FR'), true);
    }

    public function searchMovie($searchContent): array
    {
        return json_decode(file_get_contents('https://api.themoviedb.org/3/search/movie?api_key='.MOVIE_DB_API_KEY.'&language=fr-FR&query='.$searchContent.'&page=1'), true);
    }
}
