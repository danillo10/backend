<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdministrativeTaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\PlanoController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {
    Route::resource('user', UserController::class);
    Route::resource('cliente', ClienteController::class);
    Route::resource('plano', PlanoController::class);
});

Route::post('login', [LoginController::class,'login']);
Route::post('logout', [LoginController::class,'logout']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/index', [UserController::class, 'index']);
