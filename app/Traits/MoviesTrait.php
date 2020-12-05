<?php
 
namespace App\Traits;

trait MoviesTrait {

    public function getNowPlayingMovies($pageNumber): array
    {
        $result = json_decode(file_get_contents('https://api.themoviedb.org/3/movie/now_playing?api_key='.MOVIE_DB_API_KEY.'&language=fr&page='.$pageNumber), true);
        $result['results'] = $this->parseGenres($result['results']);
        return $result;
    }

    public function getMovie($id): array
    {
        return json_decode(file_get_contents('https://api.themoviedb.org/3/movie/'.$id.'?api_key='.MOVIE_DB_API_KEY.'&language=fr'), true);
    }

    public function searchMovie($stringToSearch, $pageNumber): array
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
