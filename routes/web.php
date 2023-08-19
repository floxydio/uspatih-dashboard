<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserRedeemController;
use Illuminate\Support\Facades\Route;



// Main Route
Route::get("/", [MainController::class, 'index'])->name("main");
Route::get("/setting", [SettingController::class, 'index'])->name("setting");
Route::get("/user-redeem", [UserRedeemController::class, 'index'])->name("user_redeem");

Route::post("/edit-setting", [SettingController::class, 'editSetting'])->name("edit");