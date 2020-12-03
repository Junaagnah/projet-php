<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Laravel\Lumen\Routing\Controller as BaseController;

class IndexController extends BaseController
{
    public function default(): View
    {
        return view('index');
    }
}
