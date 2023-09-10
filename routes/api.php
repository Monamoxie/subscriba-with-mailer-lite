<?php

use App\Http\Controllers\ApiKeysController;
use App\Http\Controllers\SubscribersController;
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
Route::group(['prefix' => 'v1'], function () {
    Route::post('/api_keys', [ApiKeysController::class, 'store']);
    Route::get('/api_keys', [ApiKeysController::class, 'index']);
    Route::get('/has_api_keys', [ApiKeysController::class, 'hasApiKey']);
    Route::post('/subscribers', [SubscribersController::class, 'store']);
    Route::get('/subscribers', [SubscribersController::class, 'index']);
    Route::put('/subscribers', [SubscribersController::class, 'update']);
    Route::delete('/subscribers', [SubscribersController::class, 'delete']);
});
