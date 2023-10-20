<?php

use App\Http\Resources\RedeemResource;
use App\Models\RedeemPoint;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get("/redeem-point", function () {
    $dbRes = DB::table("redeem_point")->orderBy("id", "desc")->get();
    if($dbRes == null) {
        return response()->json([
            "status" => 200,
            "data" => [],
            "message" => "Successfully Get Redeem"
        ]);
    } else {
        return response()->json([
            "status" => 200,
            "data" => $dbRes,
            "message" => "Successfully Get Redeem"
        ]);
    }
});

Route::get("/redeem-point/detail/{id}",function(Request $request, $id) {
    $dbRes = DB::table("redeem_point")->where("id", $id)->first();
    return response()->json($dbRes, 200);
});

Route::post("/redeem-point/create", function(Request $request) {
    $upload_path = base_path('./public');
    $extension = $request->file("image")->getClientOriginalExtension();
    $fileNameToStore = 'redeem_'.uniqid().'_'.time().'.'.$extension;
    $dbPostRedeem = DB::table("redeem_point")->insert([
        "point" => $request->input("point"),
        "title" => $request->input("title"),
        "picture" => $request->file("image")->move(
            $upload_path.'/uploads/', $fileNameToStore
        ),
        "quantity" => $request->input("quantity"),
        "description" => $request->input("description"),
        "active" => $request->input("active", 0),
        "createdAt" => $request->input("createdAt", new \DateTime())
    ]);

    if($dbPostRedeem == false) {
        return response()->json([
            "status" => 400,
            "error" => true,
            "message" => "Cannot Create Redeem Point"
        ],400);
    } else {
        return response()->json([
                 "status" => 201,
                 "message" => "Successfully Create Redeem"
             ],201);
    }
});


Route::put("/redeem-point/update/{id}", function(Request $request,$id) {
    if(is_string($id) || is_bool($id)) {
        return response()->json("Id must be integer", 400);
    } else {
        if($request->file("image") != null) {
            $upload_path = base_path('./public');
            $extension = $request->file("image")->getClientOriginalExtension();
            $fileNameToStore = 'redeem_'.uniqid().'_'.time().'.'.$extension;
            DB::table("redeem_point")->where("id", $id)->update([
                "point" => $request->input("point"),
                "title" => $request->input("title"),
                "picture" => $request->file("image")->move(
                    $upload_path.'/uploads/', $fileNameToStore
                ),
                "quantity" => $request->input("quantity"),
                "description" => $request->input("description"),
                "active" => $request->input("active", 0),
            ]);
            return response()->json([
                "status" => 200,
                "message" => "Successfully Update Redeem With No Image"
            ],200);
           } else {
            DB::table("redeem_point")->where("id", $id)->update([
                "point" => $request->input("point"),
                "title" => $request->input("title"),
                "quantity" => $request->input("quantity"),
                "description" => $request->input("description"),
                "active" => $request->input("active", 0),
            ]);
            return response()->json([
                "status" => 200,
                "message" => "Successfully Update Redeem"
            ],200);
        }   
    }
});

Route::get("/history-redeem", function(Request $request) {
    $dbRes = DB::select("SELECT redeem_history.*,redeem_point.point,redeem_point.title,redeem_point.picture FROM redeem_history LEFT JOIN redeem_point ON redeem_history.redeem_point_id = redeem_point.id");
    if($dbRes == null) {
        return response()->json([
            "status" => 200,
            "data" => [],
            "message" => "Successfully Get Redeem History"
        ]); 
    } else {
        return response()->json([
            "status" => 200,
            "data" => $dbRes,
            "message" => "Successfully Get Redeem History"
        ]);
    }
});

Route::post("/history-redeem/create", function(Request $request) {
    $checkForeign = DB::table("redeem_history")->where("user_id", $request->input("user_id"))->where("redeem_point_id", $request->input("redeem_point_id"))->count();
    if($checkForeign != 0) {
        return response()->json([
            "status" => 400,
            "message" => "Cannot Redeem with same Product"
        ],400);
    } else {
        $getBalance = DB::select("SELECT (SELECT SUM(stdqt_wc_points_rewards_user_points.points_balance) FROM `stdqt_wc_points_rewards_user_points` WHERE stdqt_wc_points_rewards_user_points.user_id = ?) - (SELECT SUM(redeem_balance.balance_use) FROM `redeem_balance` WHERE redeem_balance.user_id = ?) AS balance", [$request->input("user_id"),$request->input("user_id")]);
        if($getBalance[0]->balance == 0){
            return response()->json([
                "status" => 400,
                "message" => "Balance mu abis"
            ],400);
        } else if ($getBalance[0]->balance < $request->input("balance_use") ) {
            return response()->json([
                "status" => 400,
                "message" => "Balance tidak cukup"
            ],400);
        } else {
            $insertToTableRedeem = DB::table("redeem_balance")->insert([
                "user_id" => $request->input("user_id"),
                "balance_use" => $request->input("balance_use"),
                "createdAt" => $request->input("createdAt", new \DateTime())
            ]);
            if($insertToTableRedeem == false) {
                return response()->json([
                    "status" => 400,
                    "error" => true,
                    "message" => "Cannot Create To Balance Redeem Balance"
                ],400);
            } else {
              $insertRedeemHistory = DB::table("redeem_history")->insert([
                "user_id" => $request->input("user_id"),
                "redeem_point_id" => $request->input("redeem_point_id"),
                "redeemAt" => $request->input("redeemAt", new \DateTime())
              ]);
              if($insertRedeemHistory == false) {
                return response()->json([
                    "status" => 400,
                    "error" => true,
                    "message" => "Cannot Create To Redeem History"
                ],400);
              } else {
                return response()->json([
                    "status" => 200,
                    "message" => "Success Redeem Item"
                ],200);
              }
            }
        }
    }
});

Route::put("/history-redeem/update/{id}", function(Request $request, $id) {
    $edit = DB::table("redeem_history")->where("id", $id)->Update([
        "user_id" => $request->input("user_id"),
        "redeem_point_id" => $request->input("redeem_point_id")
    ]);

    if($edit == 0) {
        return response()->json([
            "status" => 400,
            "error" => true,
            "message" => "Cannot Edit History Redeem"
        ],400);
    } else {
        return response()->json([
            "status" => 200,
            "message" => "Successfully Edit History Redeem"
        ],201);
    }
});

Route::get("/history-redeem/user/{id}",function(Request $request, $id) {
    $dbRes = DB::table("redeem_history")->where("id",$id)->first();
    return response()->json($dbRes);
});


Route::get("/redeem-setting", function(Request $request) {
    $dbRes = DB::table("redeem_setting")->get();
    return response()->json($dbRes);
});

Route::put("/redeem-setting/update", function(Request $request) {
    // 0 Turn Off, 1 Turn ON
    if($request->file("image") != null) {
        $upload_path = base_path('./public');
        $extension = $request->file("image")->getClientOriginalExtension();
        $fileNameToStore = 'setting_redeem_'.uniqid().'_'.time().'.'.$extension;
        DB::table("redeem_point")->where("setting_name", "REDEEM_SETTING")->update([
            "active_status" => $request->input("active_status"),
            "image_path" => $request->file("image")->move(
                $upload_path.'/uploads/', $fileNameToStore
            ),
        ]);
        return response()->json([
            "status" => 200,
            "message" => "Successfully Update Redeem With Image"
        ],200);
    } else {
        DB::table("redeem_point")->where("setting_name", "REDEEM_SETTING")->update([
            "active_status" => $request->input("active_status"),  
        ]);
        return response()->json([
            "status" => 200,
            "message" => "Successfully Update Redeem With No Image"
        ],200);
    }
});


Route::get("/balance-all/{id}", function(Request $request, $id) {
    $dbCompare = DB::select("SELECT (SELECT SUM(stdqt_wc_points_rewards_user_points.points_balance) FROM `stdqt_wc_points_rewards_user_points` WHERE stdqt_wc_points_rewards_user_points.user_id = ?) - (SELECT SUM(redeem_balance.balance_use) FROM `redeem_balance` WHERE redeem_balance.user_id = ?) AS balance ", [$id,$id]);

    return response()->json($dbCompare[0],200);
});