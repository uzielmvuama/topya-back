<?php

use App\Http\Controllers\API\ChoiceController;
use App\Http\Controllers\API\GameController;
use App\Http\Controllers\API\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/login', [UserController::class, 'userLogin']);
Route::post('/user/add', [UserController::class, 'store']);
Route::resource('/user', GameController::class);
Route::resource('/game', GameController::class);
Route::get('/choice/{gkey}', [ChoiceController::class, 'showJoinner']);
Route::post('/choice', [ChoiceController::class, 'store']);
