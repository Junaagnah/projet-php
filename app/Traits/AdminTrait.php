<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

trait AdminTrait {

    /**
     * @param Request $request
     * @return Collection<User>
     */
    public static function searchUser(Request $request = NULL) : Collection
    {
        // If the request is not NULL check the params and query users by using the params as filters
        if (!is_null($request)) {
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
        // If the request is NULL query all user except the one that triggered this function
        } else {
            $users = DB::table('users')->where('username','!=', $_SESSION['user']['username'])->get();
        }

        return $users;
    }

    /**
     * @param Request $request
     * @return void
     */
    public static function banUser(request $request): void
    {
        $input = $request->all();
        //Update isBanned properties to true
        DB::table('users')->where('id', $input['user'])->update(['isBanned' => true]);
    }

    /**
     * @param Request $request
     * @return void
     */
    public static function unbanUser(request $request) : void
    {
        $input = $request->all();
        //Update isBanned properties to false
        DB::table('users')->where('id', $input['user'])->update(['isBanned' => false]);
    }

    /**
     * @param Request $request
     * @return void
     */
    public static function promoteUserToAdmin(Request $request) : void
    {
        $input = $request->all();
        //Update user to role Admin
        DB::table('users')->where('id', $input['user'])->update(['userRole' => ROLE_ADMIN]);
    }

    /**
     * @param Request $request
     * @return void
     */
    public static function demoteUser(Request $request) : void
    {
        $input = $request->all();
        //Update user to role User
        DB::table('users')->where('id', $input['user'])->update(['userRole' => ROLE_USER]);
    }

    /**
     * @param Request $request3
     * @return void
     */
    public static function adminDeleteReview(Request $request): void {
        $input = $request->all();
        // Delete the review
        DB::table('reviews')->where('id', $input['id'])->delete();
    }
}
