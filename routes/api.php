<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/// LOGIN
Route::post("login",[UserController::class,'login']);


Route::group(['middleware' => 'auth:sanctum'], function(){

    Route::resource("companies", CompanyController::class);
    Route::resource("employees", EmployeeController::class);

});




