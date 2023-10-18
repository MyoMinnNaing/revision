<?php

use App\Http\Controllers\Auth\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function()   {
  Route::middleware('auth:sanctum')->group(function() {





     // For ApiAuthController.php
     Route::controller(ApiAuthController::class)->group(function(){
                  Route::post('/logout', 'logout');
                  Route::get('/access-token', 'accessToken');
     });
  });

  Route::post('/login',[ApiAuthController::class, 'login'])->name('login')->middleware('guest');

});
