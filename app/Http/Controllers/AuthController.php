<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller {
    public function index() {
        $isCookieAdmin = Cookie::get("admin");

        if($isCookieAdmin == null) {
            return view("sign_in");
        } else {
            return redirect("/");
        }
    }
    public function login(Request $request) {
        $dbRes = DB::table("redeem_admin")->where("username", $request->input("username"))->where("password", $request->input("password"))->first();
        if($dbRes == null) {
            return redirect("/login")->with("error", "Username or password is incorrect");
        } else {
            Cookie::queue("admin", $dbRes->username, 60 * 24 * 30);
            Cookie::queue("name", $dbRes->name, 60 * 24 * 30);
            return redirect("/");
        }
    }

    public function logout(Request $request) {
        Cookie::queue(Cookie::forget("admin"));
        Cookie::queue(Cookie::forget("name"));
        return redirect("/login");
    }
}