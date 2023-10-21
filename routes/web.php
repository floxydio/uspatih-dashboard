<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserRedeemController;
use Illuminate\Support\Facades\Route;



// Main Route
Route::get("/", [MainController::class, 'index'])->name("main");
Route::get("/setting", [SettingController::class, 'index'])->name("setting");
Route::get("/user-redeem", [UserRedeemController::class, 'index'])->name("user_redeem");
Route::get("/login", [AuthController::class, 'index'])->name("login");
Route::post("/sign-in", [AuthController::class, 'login'])->name("login.create");
Route::get("/logout", [AuthController::class, 'logout'])->name("logout");

Route::post("/edit-setting", [SettingController::class, 'editSetting'])->name("edit");
Route::post("/edit-redeem/{id}", [MainController::class, 'editRedeem'])->name("edit.redeem");
Route::post("/create-redeem", [MainController::class, 'createRedeem'])->name("create.redeem");
Route::get("/delete-redeem/{id}", [MainController::class, 'deleteRedeem'])->name("delete.redeem");