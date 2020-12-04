<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use \App\Traits\MoviesTrait;
use Illuminate\Http\RedirectResponse;

class IndexController extends BaseController
{
    use MoviesTrait;

    public function default(Request $request): View | RedirectResponse
    {
        $pageNumber = intval($request->input('pageNumber'));
        if ($pageNumber <= 0) {
            $pageNumber = 1;
            return redirect('/?pageNumber='.$pageNumber);
        }
        $results = $this->getNowPlayingMovies($pageNumber);
        if (intval($results['total_pages']) < $pageNumber) {
            return redirect('/?pageNumber='.$results['total_pages']);
        }
        return view('index', ['movies' => $results, 'pageNumber' => $pageNumber]);
    }
}
