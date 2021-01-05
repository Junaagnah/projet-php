<?php


namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Laravel\Lumen\Routing\Controller as BaseController;


class AdminController extends BaseController
{
    /**
     * @return View
     */
    public function show() : View
    {
        $users = DB::table('users')->where('username','!=', $_SESSION['user']['username'])->get();
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
        $input = $request->all();

        if ($input['role'] === "all" & $input['search'] != "")
        {
            $users = DB::table('users')->where('email', 'like', '%'.$input['search'].'%')->orwhere('username', 'like','%'.$input['search'].'%')->where('username','!=', $_SESSION['user']['username'])->get();
        }

        if ($input['search'] === "" & $input['role'] != "all")
        {
            $users = DB::table('users')->where('userRole', $input['role'])->where('username','!=', $_SESSION['user']['username'])->get();
        }

        if ($input['search'] !== "" & $input['role'] != "all"){
            $users = DB::table('users')->where('email', 'like', '%'.$input['search'].'%')->orWhere('username', 'like', '%'.$input['search'].'%')->where('userRole', $input['role'])->where('username','!=', $_SESSION['user']['username'])->get();
        }

        if ($input['role'] === "all" & $input['search'] === "") {
            $users = DB::table('users')->where('username','!=', $_SESSION['user']['username'])->get();
        }

        return view('admin', ["users" => $users]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function banUser(request $request) : View
    {
        $input = $request->all();
        //Update isBanned properties to true
        DB::table('users')->where('id', $input['user'])->update(['isBanned' => true]);
        //Search all user
        $users = DB::table('users')->where('username','!=', $_SESSION['user']['username'])->get();
        return view('admin', ["users" => $users]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function unbanUser(request $request) : View
    {
        $input = $request->all();
        //Update isBanned properties to false
        DB::table('users')->where('id', $input['user'])->update(['isBanned' => false]);
        //Search all user
        $users = DB::table('users')->where('username','!=', $_SESSION['user']['username'])->get();
        return view('admin', ["users" => $users]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function promoteUserToAdmin(Request $request) : View
    {
        $input = $request->all();
        //Update user to role Admin
        DB::table('users')->where('id', $input['user'])->update(['userRole' => ROLE_ADMIN]);
        //Search all user
        $users = DB::table('users')->where('username','!=', $_SESSION['user']['username'])->get();
        return view('admin', ["users" => $users]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function demoteUser(Request $request) : View
    {
        $input = $request->all();
        //Update user to role User
        DB::table('users')->where('id', $input['user'])->update(['userRole' => ROLE_USER]);
        //Search all user
        $users = DB::table('users')->where('username','!=', $_SESSION['user']['username'])->get();
        return view('admin', ["users" => $users]);
    }

    /**
     * @param Request $request
     */
    public function adminDeleteReview(Request $request) {
        $input = $request->all();
        // Delete the review
        DB::table('reviews')->where('id', $input['id'])->delete();
        return redirect('/movieOverview?movieId=' . $input['FK_movieId']);
    }
}
