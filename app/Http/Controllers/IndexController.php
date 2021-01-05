<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Traits\MoviesTrait;

class IndexController extends BaseController
{

    /**
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function default(Request $request)
    {
        // If the requested page number is lower or equal to zero, redirect on page 1
        $pageNumber = intval($request->input('pageNumber'));
        if ($pageNumber <= 0) {
            $pageNumber = 1;
            return redirect('/?pageNumber='.$pageNumber);
        }
        // Get the now playing movies of the requested page
        $results = MoviesTrait::getNowPlayingMovies($pageNumber);
        // If the requested page excess the maximum numbe of page, redirect on the last page
        if (intval($results['total_pages']) < $pageNumber) {
            return redirect('/?pageNumber='.$results['total_pages']);
        }
        return View('index', ['movies' => $results, 'pageNumber' => $pageNumber, 'stringToSearch' => null]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function search(Request $request) {
        $stringToSearch = $request->input('searchByTitle');
        $pageNumber = intval($request->input('pageNumber'));
        // If the string to search length equal zero, redirect on index page
        if (strlen($stringToSearch) === 0) {
            return redirect('/');
        }
        // If the page number is lower or equal zero, set the page number to one and redirect on the current URL wuth the new page number
        if ($pageNumber <= 0) {
            $pageNumber = 1;
            return redirect('/search?searchByTitle='.$stringToSearch.'&pageNumber='.$pageNumber);
        }
        // Get the movies using the args
        $results = MoviesTrait::searchMovies($stringToSearch, $pageNumber);
        // If there is zero page, set the resuts to null
        if (intval($results['total_pages']) === 0) {
            $results = null;
        // If the request page excess the total pages redirect on the last page
        } else if (intval($results['total_pages']) < $pageNumber) {
            return redirect('/search?searchByTitle='.$stringToSearch.'&pageNumber='.$results['total_pages']);
        }
        return View('index', ['movies' => $results, 'pageNumber' => $pageNumber, 'stringToSearch' => $stringToSearch]);
    }
}
