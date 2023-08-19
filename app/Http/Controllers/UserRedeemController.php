<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

class UserRedeemController extends Controller {
   public function index() {
      $getEnv = env("APP_URL_GO");

        $userredeem = Http::get("$getEnv/history-redeem")["data"];
        return view("dashboard/user_redeem", compact("userredeem"));
   }
}