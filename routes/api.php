<?php

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function()   {
  Route::middleware('auth:sanctum')->group(function() {

    Route::apiResource('stock',StockController::class);



     // For ApiAuthController.php
     Route::controller(ApiAuthController::class)->group(function(){
                  Route::post('/logout', 'logout');
                  Route::post('/change-password', 'changePassword');
                  Route::get('/access-token', 'accessToken');
     });


     Route::controller(UserController::class)->group(function() {
            Route::post('/user/register', 'register');
            Route::put('user/update-role/{id}', 'updateRole');
            Route::put('user/ban/{id}', 'ban');

     });
  });

  Route::post('/login',[ApiAuthController::class, 'login'])->name('login')->middleware('guest');

});
