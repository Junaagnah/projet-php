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
        $pageNumber = intval($request->input('pageNumber'));
        if ($pageNumber <= 0) {
            $pageNumber = 1;
            return redirect('/?pageNumber='.$pageNumber);
        }
        $results = MoviesTrait::getNowPlayingMovies($pageNumber);
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
        if (strlen($stringToSearch) === 0) {
            return redirect('/');
        }
        if ($pageNumber <= 0) {
            $pageNumber = 1;
            return redirect('/search?searchByTitle='.$stringToSearch.'&pageNumber='.$pageNumber);
        }
        $results = MoviesTrait::searchMovies($stringToSearch, $pageNumber);
        if (intval($results['total_pages']) === 0) {
            $results = null;
        } else if (intval($results['total_pages']) < $pageNumber) {
            return redirect('/search?searchByTitle='.$stringToSearch.'&pageNumber='.$results['total_pages']);
        }
        return View('index', ['movies' => $results, 'pageNumber' => $pageNumber, 'stringToSearch' => $stringToSearch]);
    }
}
