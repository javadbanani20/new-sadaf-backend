<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('product/store',[\App\Http\Controllers\ProductController::class,'StoreProduct']);
Route::get('product/{product:id}/show',[\App\Http\Controllers\ProductController::class,'show']);
Route::get('product/list',[\App\Http\Controllers\ProductController::class,'showList']);
Route::put('product/{product}/update',[\App\Http\Controllers\ProductController::class,'update']);
Route::delete('product/{product}/delete',[\App\Http\Controllers\ProductController::class,'delete']);
Route::post('auth/check/user/exist' ,[\App\Http\Controllers\UserController::class,'checkUser']);
Route::post('auth/check/user/exist' ,[\App\Http\Controllers\UserController::class,'checkUser']);
Route::post('auth/check/user/otp' , [\App\Http\Controllers\UserController::class , 'checkOtp']);
Route::post('auth/user/store',[\App\Http\Controllers\UserController::class,'store']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    Route::get('user/{user}/info',[\App\Http\Controllers\UserController::class,'User_info']);

});


