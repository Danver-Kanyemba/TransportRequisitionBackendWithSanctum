<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransportRequestController;

Route::post('/authenticate', [AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('transportr', TransportRequestController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::Get('login', function()
{ 
    return ('login');
})->name('login');