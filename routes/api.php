<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ForgetPasswordController;
use App\Http\Controllers\api\RestController;
use App\Http\Controllers\api\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register',[AuthController::class,'Register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/forget_password',[ForgetPasswordController::class,'forget']);
Route::post('/rest_password',[RestController::class,'restPassword']);
Route::get('/user',[UserController::class,'user'])->middleware('auth:api');
