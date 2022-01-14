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
Route::get('user/{id}', [UserController::class, 'show'])->middleware('auth:sanctum');

Route::apiResource('songs', SongController::class);
// Route::get('songs/{id}', [SongController::class, 'show']);
// Route::post('songs', [SongController::class, 'store']);
// Route::patch('songs/{id}', [SongController::class, 'update']);
// Route::delete('songs/{id}', [SongController::class, 'destroy']);