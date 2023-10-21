<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MainController extends Controller {
   public function index() {
      $isCookieAdmin = Cookie::get("admin");

      if($isCookieAdmin == null) {
         return redirect("/login");
      } else {
         $dbRes = DB::table("redeem_point")->orderBy("id", "desc")->get();
         $redeem = $dbRes;
         
           return view("dashboard/main", compact('redeem'));
      }
   }

   public function editRedeem($id, Request $request) {
         $image = $request->file('image');

         if($image == null) {
            $data = [
               "point" => (int)$request->input("point", 0),
               "title" => $request->input("title"),
               "active_status" => (int)$request->input("active_status"),
               "description" => $request->input("description"),
            ];
           DB::select("UPDATE redeem_point SET point = ?, title = ?, active = ?, description = ? WHERE id = ?", [$data["point"], $data["title"], $data["active_status"], $data["description"], $id]);

         } else {
            $upload_path = base_path('./public');
            $extension = $request->file("image")->getClientOriginalExtension();
            $fileNameToStore = 'redeem_'.uniqid().'_'.time().'.'.$extension;
            $data = [
               "point" => (int)$request->input("point"),
               "title" => $request->input("title"),
               "active_status" => (int)$request->input("active_status"),
               "description" => $request->input("description"),
               "image" =>  $request->file("image")->move(
                  $upload_path.'/uploads/', $fileNameToStore
              ),
            ];
            DB::select("UPDATE redeem_point SET point = ?, title = ?, active_status = ?, description = ?, image = ? WHERE id = ?", [$data["point"], $data["title"], $data["active_status"], $data["description"], $data["image"], $id]);

         }
         
         return redirect("/");

      }
      public function createRedeem(Request $request) {
         $upload_path = base_path('./public');
         $extension = $request->file("image")->getClientOriginalExtension();
         $fileNameToStore = 'redeem_'.uniqid().'_'.time().'.'.$extension;
         $request->file("image")->move(
            $upload_path.'/uploads/', $fileNameToStore
         );
          DB::table("redeem_point")->insert([
             "point" => $request->input("point"),
             "title" => $request->input("title"),
             "picture" => $fileNameToStore,
             "quantity" => $request->input("quantity"),
             "description" => $request->input("description"),
             "active" => $request->input("active_status", 0),
         ]);
         return redirect("/");
      }

      public function deleteRedeem($id) {
         DB::table("redeem_point")->where("id", $id)->delete();
         return redirect("/");
      }

   }