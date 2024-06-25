<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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
Route::post('/register', [RegisterController::class,'register']);

Route::middleware('auth:sanctum')->group(function () {
    // user route
    Route::get('/users',[UserController::class,'index']);
    Route::post('/users/create',[UserController::class,'create']);
    Route::delete('/users/delete/{id}',[UserController::class,'destroy']);
    //classroom route
    Route::get('/classrooms',[ClassroomController::class,'index']);
    //role route
    Route::get('/roles',[RoleController::class,'index']);
    Route::post('/roles/create',[RoleController::class,'create']);
    Route::put('/roles/update/{id}',[RoleController::class,'update']);
    Route::delete('/roles/delete/{id}',[RoleController::class,'destroy']);
    //permission route
    Route::get('/permissions',[PermissionController::class,'index']);
    //class route
    Route::get('/classes',[ClassroomController::class,'index']);
    Route::post('classes/create',[ClassroomController::class,'create']);
    Route::put('/classes/update/{id}',[ClassroomController::class,'update']);
    Route::delete("/classes/delete/{id}",[ClassroomController::class,'destroy']);

    //auth route
    Route::get('/logout',[LoginController::class,'logout']);
});

