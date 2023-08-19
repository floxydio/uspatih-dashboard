<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class MainController extends Controller {
   public function index() {
        $getEnv = env("APP_URL_GO");
        $redeem = Http::get("$getEnv/redeem")["data"];
        return view("dashboard/main", compact('redeem'));
   }
}