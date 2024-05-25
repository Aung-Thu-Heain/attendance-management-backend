<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;

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

Route::post('/login',[LoginController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {
    // user route
    Route::get('/users',[UserController::class,'index']);
    //classroom route
    Route::get('/classrooms',[ClassroomController::class,'index']);
    //role route
    Route::get('/roles',[RoleController::class,'index']);
    Route::put('/roles/update/{id}',[RoleController::class,'update']);
    //permission route
    Route::get('/permissions',[PermissionController::class,'index']);
    //class route
    Route::get('/classes',[ClassroomController::class,'index']);
});

