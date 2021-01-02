<?php
 
namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait MoviesTrait {

    public function getNowPlayingMovies($pageNumber): array
    {
        $result = json_decode(file_get_contents('https://api.themoviedb.org/3/movie/now_playing?api_key='.MOVIE_DB_API_KEY.'&language=fr&page='.$pageNumber), true);
        $result['results'] = $this->parseGenres($result['results']);
        return $result;
    }

    public function getMovie($id): array
    {
        $result = array();
        // Get the movie from the MovieDB API
        $result['movie'] = json_decode(file_get_contents('https://api.themoviedb.org/3/movie/'.$id.'?api_key='.MOVIE_DB_API_KEY.'&language=fr'), true);
        // Get the related reviews from our DB
        $result['reviews'] = json_decode(DB::table('reviews')->where('FK_movieID', $id)->join('users', 'reviews.FK_userID', '=', 'users.id')->select('reviews.*', 'users.username')->orderByDesc('reviews.updated_at')->get(), true);

        // Set the average note from our DB reviews
        $averageNoteTotal = 0;
        foreach ($result['reviews'] as &$value) {
            $averageNoteTotal = $averageNoteTotal + $value['note'];
        }
        
        if (count($result['reviews']) > 0) {
            $result['movie']['average_note'] = round($averageNoteTotal / count($result['reviews']), 1);
        } else {
            $result['movie']['average_note'] = NULL;
        }

        return $result;
    }

    public function searchMovies($stringToSearch, $pageNumber): array
    {
        $result = json_decode(file_get_contents('https://api.themoviedb.org/3/search/movie?api_key='.MOVIE_DB_API_KEY.'&language=fr&query='.urlencode($stringToSearch).'&page='.$pageNumber), true);
        $result['results'] = $this->parseGenres($result['results']);
        return $result;
    }

    private function parseGenres(array $moviesArray) {
        $genresArray = json_decode(file_get_contents('https://api.themoviedb.org/3/genre/movie/list?api_key='.MOVIE_DB_API_KEY.'&language=fr'), true)['genres'];
        foreach ($moviesArray as &$movie) {
            $movieParsedGenres = array();
            foreach ($movie['genre_ids'] as $genreId) {
                $genreAndGenreClassname = array();
                $genreAndGenreClassname['genre'] = $genresArray[array_search($genreId, array_column($genresArray, 'id'))]['name'];
                $genreAndGenreClassname['genreClassName'] = str_replace('\'', '', iconv('UTF-8','ASCII//TRANSLIT', $genreAndGenreClassname['genre']));
                array_push($movieParsedGenres, $genreAndGenreClassname);
            }
            $movie['genre'] = $movieParsedGenres;
        }
        return $moviesArray;
    }
}
