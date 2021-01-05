<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Laravel\Lumen\Http\Request;

class AdministrationGuard
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
        // Check if the variable $_SESSION is full and if the user is admin, if not redirect on the landing page
        if (empty($_SESSION['user']) || $_SESSION['user']['userRole'] !== ROLE_ADMIN) {
            return redirect('/');
        }

        return $next($request);
    }
}
