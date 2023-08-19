<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SettingController extends Controller {
   public function index() {
    $getEnv = env("APP_URL_GO");

        $setting = Http::get("$getEnv/setting")["data"];
        return view("dashboard/setting", compact("setting"));
   }

   public function editSetting(Request $request) {
    $image = $request->file('image');
    $getEnv = env("APP_URL_GO");
    $data = [];

    if($image == null) {
      $data = [
        "active_status" => $_POST["active_status"],
      ];
    } else {
      $data = [
        "active_status" => $_POST["active_status"],
        "image" => $image->getClientOriginalExtension()
      ];
    }
   

    $response = Http::put("$getEnv/edit-setting/REDEEM_SETTING",$data);

  if ($response->successful()) {
      return redirect()->back()->with('message', 'Image updated successfully');
  } else {
      return redirect()->back()->with('error', 'Failed to update image');
  }
   }
}