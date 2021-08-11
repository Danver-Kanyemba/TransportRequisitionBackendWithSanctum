<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransportRequestController;
use App\Http\Controllers\Api\DepartmentsController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\HODController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DepartmentsAndHODController;
use App\Http\Controllers\Api\TransportOfficer;
use App\Http\Controllers\Api\AllUsersController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\TransportOfficerController;
use App\Http\Controllers\Api\checkIfAdminController;

Route::post('/authenticate', [AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('transportr', TransportRequestController::class);
    Route::apiResource('transport',TransportRequestController::class);
    Route::apiResource('hod',HODController::class);
    Route::apiResource('munhuwacho',UserController::class);
    Route::apiResource('TransportOfficer',TransportOfficer::class);
    Route::apiResource('officercontrol',TransportOfficerController::class);
    Route::apiResource('admincontrol',AdminController::class);
    Route::apiResource('/isadmin',checkIfAdminController::class);
    Route::get('/authenticate', [AuthController::class,'index']);
    // Route::get('/isadmin', [AuthController::class,'Administrator']);
    Route::get('/istransportofficer', [AuthController::class,'checkTransportOfficer']);

    
});
Route::apiResource('register',RegisterController::class);
Route::apiResource('allusers',AllUsersController::class);
Route::apiResource('departments',DepartmentsController::class);
Route::apiResource('hodAndDepartments',DepartmentsAndHODController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $user = $request->user();
    $user->tokens()->delete();
    Auth::guard('web')->logout();
    return 'message';
});

Route::Get('login', function()
{ 
    return ('login unsuccessfull');
})->name('login');

