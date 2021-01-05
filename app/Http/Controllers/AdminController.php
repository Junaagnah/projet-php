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
    public function show()
    {
        $users = AdminTrait::searchUser(NULL);
        return view('admin', ["users" => $users]);
    }

    /**
     * @return RedirectResponse
     */
    public function redirectToAdmin()
    {
        return redirect('/admin');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function searchUser(Request $request)
    {
        $users = AdminTrait::searchUser($request);
        return view('admin', ["users" => $users]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function banUser(request $request)
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
    public function unbanUser(request $request)
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
    public function promoteUserToAdmin(Request $request)
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
    public function demoteUser(Request $request)
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
    public function adminDeleteReview(Request $request)
    {
        $input = $request->all();
        // Delete the review
        AdminTrait::adminDeleteReview($request);
        return redirect('/movieOverview?movieId=' . $input['FK_movieId']);
    }
}
