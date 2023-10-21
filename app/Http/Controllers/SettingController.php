<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SettingController extends Controller {
   public function index() {
    $isCookieAdmin = Cookie::get("admin");

    if($isCookieAdmin == null) {
        return redirect("/login");
    } else {
      $dbRes = DB::table("redeem_setting")->get();
      $setting = $dbRes[0];
        return view("dashboard/setting", compact("setting"));
    }
  }
   

   public function editSetting(Request $request) {
    $image = $request->file('image');
    if($image == null) {
      $data = [
        "active_status" => $_POST["active_status"],
      ];
      DB::table("redeem_setting")->where("setting_name", "REDEEM_SETTING")->update($data);
    } else {
      $upload_path = base_path('./public');
      $extension = $request->file("image")->getClientOriginalExtension();
      
      $fileNameToStore = 'setting_redeem_'.uniqid().'_'.time().'.'.$extension;
      $request->file("image")->move(
        $upload_path.'/uploads/', $fileNameToStore
      );
      $data = [
        "active_status" => $_POST["active_status"],
        "image" => $fileNameToStore,
      ];
      DB::table("redeem_setting")->where("setting_name", "REDEEM_SETTING")->update($data);
    }
    return redirect()->route("setting");
  }
}