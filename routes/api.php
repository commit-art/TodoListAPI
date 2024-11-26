<?php

use App\Http\Controllers\Auth\Api\SanctumController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'user'], function () {
        Route::post('create', [UserController::class, 'create']);
    });

    Route::post('tokens/create', [SanctumController::class, 'create']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::apiResource('tasks', TaskController::class);

        Route::get('user', function (Request $request) {
            return $request->user();
        });

        Route::get('user/index', [UserController::class, 'index']);

        Route::post('tokens/revoke_all', [SanctumController::class, 'revokeAll']);
    });
});
