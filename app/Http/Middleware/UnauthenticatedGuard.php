<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Laravel\Lumen\Http\Request;

class UnauthenticatedGuard
{
    /**
     * The authentication guard factory instance.
     *
     * @var Auth
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param Auth $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        // We check if the user is not authenticated, if he is authenticated redirect on the landing page
        if (!empty($_SESSION['user'])) {
            return redirect('/');
        }

        return $next($request);
    }
}
