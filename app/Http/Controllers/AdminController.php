<?php


namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Traits\AdminTrait;
use Laravel\Lumen\Routing\Controller as BaseController;


class AdminController extends BaseController
{
    /**
     * @return View
     */
    public function show() : View
    {
        $users = AdminTrait::searchUser(NULL);
        return view('admin', ["users" => $users]);
    }

    /**
     * @return RedirectResponse
     */
    public function redirectToAdmin(): RedirectResponse
    {
        return redirect('/admin');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function searchUser(Request $request) : View
    {
        $users = AdminTrait::searchUser($request);
        return view('admin', ["users" => $users]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function banUser(request $request) : View
    {
        // Ban the user
        AdminTrait::banUser($request);
        // Return the admin view with all users
        $users = AdminTrait::searchUser(NULL);
        return view('admin', ["users" => $users]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function unbanUser(request $request) : View
    {
        // Unban the user
        AdminTrait::unbanUser($request);
        // Return the admin view with all users
        $users = AdminTrait::searchUser(NULL);
        return view('admin', ["users" => $users]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function promoteUserToAdmin(Request $request) : View
    {
        // Promote the user
        AdminTrait::promoteUserToAdmin($request);
        // Return the admin view with all users
        $users = AdminTrait::searchUser(NULL);
        return view('admin', ["users" => $users]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function demoteUser(Request $request) : View
    {
        // Demote the user
        AdminTrait::demoteUser($request);
        // Return the admin view with all users
        $users = AdminTrait::searchUser(NULL);
        return view('admin', ["users" => $users]);
    }
    
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function adminDeleteReview(Request $request) {
        $input = $request->all();
        // Delete the review
        AdminTrait::adminDeleteReview($request);
        return redirect('/movieOverview?movieId=' . $input['FK_movieId']);
    }
}
