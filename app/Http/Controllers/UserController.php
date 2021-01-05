<?php

namespace App\Http\Controllers;

use App\Traits\MoviesTrait;
use App\Traits\SessionTrait;
use App\Traits\UserTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\User;

class UserController extends BaseController {

    /**
     * @param Request $request
     * @param string $username
     * @return View
     */
    public function showUserProfile(Request $request, string $username)
    {
        return UserTrait::showUserProfile($username);
    }

    /**
     * @param Request $request
     * @param string $username
     * @return View|string|RedirectResponse
     */
    public function editUserAction(Request $request, string $username)
    {
        return UserTrait::editUserAction($request, $username);
    }
}
