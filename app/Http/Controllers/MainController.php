<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class MainController extends Controller {
   public function index() {
        $getEnv = env("APP_URL_GO");
        $redeem = Http::get("$getEnv/redeem")["data"];
        return view("dashboard/main", compact('redeem'));
   }

   public function editRedeem($id, Request $request) {
         $getEnv = env("APP_URL_GO");
         $image = $request->file('image');

         if($image == null) {
            $data = [
               "point" => (int)$_POST["point"],
               "title" => $_POST["title"],
               "active_status" => (int)$_POST["active_status"],
               "description" => $_POST["description"],
            ];
         } else {
            $data = [
               "point" => (int)$_POST["point"],
               "title" => $_POST["title"],
               "description" => $_POST["description"],
               "active_status" => (int)$_POST["active_status"],
               "image" => $image->getClientOriginalExtension()
            ];
         }
   
         $response = Http::withHeaders([
            'Content-Type' => 'application/json',
         ])->asJson()->put("$getEnv/edit-redeem/$id",$data);
         if($response->successful()) {
            return redirect("/");
         } else {
            return redirect("/");
         }

      }
}