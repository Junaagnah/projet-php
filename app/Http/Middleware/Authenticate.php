<?php

namespace App\Http\Middleware;

use App\Traits\SessionTrait;
use App\Models\User;
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
     * This guard is called on each request, we set the $_SESSION const based on the user matching the username stored in the user cookie
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        // Checking if user is connected
        $encryptedUsername = $request->cookie(COOKIE_SESSION_KEY);

        // If the user is not connected the request can continue
        if (empty($encryptedUsername))
            return $next($request);

        // Get the username from the encrypted data in the cookie
        $username = SessionTrait::getSessionCookieValue($encryptedUsername);

        // If the username is not empty, the matching user is queryed
        if (!empty($username)) {
            $user = User::getOneUserByUsername($username);
            // If there is a matching user for this username
            if (!empty($user)) {
                // Check if the user is banned
                if (!$user['isBanned']) {
                    // If the user exists, we set his account in the session global variable
                    $_SESSION['user'] = $user;
                }
                // If the user is banned, we disconnect him and redirect him to the errors page
                else {
                    SessionTrait::unsetSessionCookie();
                    return view('errors', ['error' => 'Vous avez été banni et vous ne pouvez plus vous connecter.']);
                }
            }
            // If no user match the username we delete the cookie
            else {
                SessionTrait::unsetSessionCookie();
            }
        }

        return $next($request);
    }
}
