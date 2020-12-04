<?php

namespace App\Http\Middleware;

use App\Traits\SessionTrait;
use App\User;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Laravel\Lumen\Http\Request;

class Authenticate
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
        // Checking if user is connected
        $encryptedUsername = $request->cookie(COOKIE_SESSION_KEY);

        if (empty($encryptedUsername))
            return $next($request);

        $username = SessionTrait::getSessionCookieValue($encryptedUsername);

        if (!empty($username)) {
            $user = User::getOneUserByUsername($username);
            if (!empty($user)) {
                // If the user exists, we set his account in the session global variable and reset a new cookie
                $_SESSION['user'] = $user;
                SessionTrait::setSessionCookie($username);
            }
        }

        return $next($request);
    }
}
