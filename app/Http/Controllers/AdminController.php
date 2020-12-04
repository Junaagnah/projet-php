<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Lumen\Routing\Controller as BaseController;


class AdminController extends BaseController
{
    /**
     * @return View
     */
    public function show() : View
    {
        $users = app('db')->select("SELECT * FROM users");
        return view('admin', ["users" => $users]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function searchUser(Request $request) : View
    {
        $input = $request->all();

        if ($input['role'] === "all" & $input['query'] != "") {
            $users = app('db')->select("SELECT * FROM `users` WHERE `email` = '". $input['query'] ."' OR `username` = '". $input['query'] ."'");
        }

        if ($input['query'] === "" & $input['role'] != "all")
        {
            $users = app('db')->select("SELECT * FROM `users` WHERE `userRole` = '". $input['role'] ."'");
        }

        if ($input['query'] !== "" & $input['role'] != "all"){
            $users = app('db')->select("SELECT * FROM `users` WHERE `email` = '". $input['query'] ."' OR `username` = '". $input['query'] ."' AND `userRole` = '". $input['role'] ."'");
        }

        if ($input['role'] === "all" & $input['query'] === "") {
            $users = app('db')->select("SELECT * FROM `users`");
        }

        //Search user where pseudo is equal to query
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
        app('db')->update("UPDATE `users` SET isBanned = true  WHERE `id` = '". $input['user'] ."'");
        //Search all user
        $users = app('db')->select("SELECT * FROM users");
        return view('admin', ["users" => $users]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function unbanUser(request $request) : View
    {
        $input = $request->all();
        //Update isBanned properties to true
        app('db')->update("UPDATE `users` SET isBanned = false  WHERE `id` = '". $input['user'] ."'");
        //Search all user
        $users = app('db')->select("SELECT * FROM users");
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
        app('db')->update("UPDATE `users` SET `userRole` = 'ROLE_MODERATOR'  WHERE `id` = '". $input['user'] ."'");
        //Search all user
        $users = app('db')->select("SELECT * FROM users");
        return view('admin', ["users" => $users]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function promoteUserToAdmin(Request $request) : View
    {
        $input = $request->all();
        //Update user to role Moderator
        app('db')->update("UPDATE `users` SET `userRole` = 'ROLE_ADMIN'  WHERE `id` = '". $input['user'] ."'");
        //Search all user
        $users = app('db')->select("SELECT * FROM users");
        return view('admin', ["users" => $users]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function demoteUser(Request $request) : View
    {
        $input = $request->all();
        //Update user to role Moderator
        app('db')->update("UPDATE `users` SET `userRole` = 'ROLE_USER'  WHERE `id` = '". $input['user'] ."'");
        //Search all user
        $users = app('db')->select("SELECT * FROM users");
        return view('admin', ["users" => $users]);
    }
}
