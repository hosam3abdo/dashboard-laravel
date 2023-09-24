<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apis\ProductController;
use App\Http\Controllers\apis\auth\LoginController;
use App\Http\Controllers\apis\Auth\ProfileController;
use App\Http\Controllers\apis\Auth\PasswordController;
use App\Http\Controllers\apis\Auth\RegisterController;
use App\Http\Controllers\apis\Auth\EmailVerificationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// requests
Route::group(['prefix'=>'products','middleware'=>'VerifiedApi'],function(){
    Route::get('/',[ProductController::class,'index']); // method => get , url = 127.0.0.1:8000/api/v1/products , headers => Accept:Application/json
    Route::get('/create',[ProductController::class,'create']);
    Route::get('edit/{id}',[ProductController::class,'edit']);
    Route::post('store',[ProductController::class,'store']);
    Route::put('update/{id}',[ProductController::class,'update']);
    Route::delete('destroy',[ProductController::class,'destroy']);
});

// authentication token
Route::group(['prefix'=>'users'],function(){
    // guest
    Route::post('register',RegisterController::class); // invokable controller
    Route::post('login',[LoginController::class,'login']);
    Route::post('check-email',[PasswordController::class,'checkEmail']);
    // auth
    Route::group(['middleware'=>'auth:sanctum'],function(){
        Route::post('send-code',[EmailVerificationController::class,'sendCode']);
        Route::post('check-code',[EmailVerificationController::class,'checkCode']);
        Route::post('email-verification',[EmailVerificationController::class,'emailVerification']);
        Route::post('logout',[LoginController::class,'logout']);
        Route::post('logout-all',[LoginController::class,'logoutAll']);
    });

    // verified
    Route::group(['middleware'=>'VerifiedApi'],function(){
        Route::post('profile',ProfileController::class);
        Route::post('set-new-password',[PasswordController::class,'setNewPassword']);
    });
});
