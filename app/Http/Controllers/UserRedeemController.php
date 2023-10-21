<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class UserRedeemController extends Controller {
   public function index() {
     $isCookie = Cookie::get("admin");
     if($isCookie == null) {
         return redirect("/login");
     } else {
      $dbRes = DB::select("SELECT redeem_history.*,redeem_point.point,redeem_point.title,redeem_point.picture FROM redeem_history LEFT JOIN redeem_point ON redeem_history.redeem_point_id = redeem_point.id");
      $userredeem = $dbRes;
      return view("dashboard/user_redeem", compact("userredeem"));
     }
   }
}