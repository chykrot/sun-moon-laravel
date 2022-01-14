<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ SongController, UserController };

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


Route::post('login', [UserController::class, 'login']);
Route::get('songs', [SongController::class, 'index']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('logout', [UserController::class, 'logout']);
    Route::get('user/{id}', [UserController::class, 'show']);

    Route::post('songs', [SongController::class, 'store']);
    Route::get('songs/{id}', [SongController::class, 'show']);
    Route::patch('songs/{id}', [SongController::class, 'update']);
    Route::delete('songs/{id}', [SongController::class, 'destroy']);
    
});