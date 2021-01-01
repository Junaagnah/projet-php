<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Laravel\Lumen\Routing\Controller as BaseController;


class AdminController extends BaseController
{
    /**
     * @return View
     */
    public function show() : View
    {
        $users = DB::table('users')->get();
        return view('admin', ["users" => $users]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function searchUser(Request $request) : View
    {
        $input = $request->all();

        if ($input['role'] === "all" & $input['search'] != "") {
            $users = DB::table('users')->where('email', $input['search'])->orwhere('username', $input['search'])->get();
        }

        if ($input['search'] === "" & $input['role'] != "all")
        {
            $users = DB::table('users')->where('userRole', $input['role'])->get();
        }

        if ($input['search'] !== "" & $input['role'] != "all"){
            $users = DB::table('users')->where('email' , [$input['search']])->orWhere('username', $input['search'])->where('userRole', $input['role'])->get();
        }

        if ($input['role'] === "all" & $input['search'] === "") {
            $users = DB::table('users')->get();
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
        $users = DB::table('users')->get();
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
        $users = DB::table('users')->get();
        return view('admin', ["users" => $users]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function promoteUserToModerator(Request $request) : View
    {
        $input = $request->all();
        //Update user to role Moderator
        DB::table('users')->where('id', $input['user'])->update(['userRole' => ROLE_MODERATOR]);
        //Search all user
        $users = DB::table('users')->get();
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
        $users = DB::table('users')->get();
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
        $users = DB::table('users')->get();
        return view('admin', ["users" => $users]);
    }
}
