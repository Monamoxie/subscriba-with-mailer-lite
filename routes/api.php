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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::post('/api_key/store', [ApiKeysController::class, 'store']);
    Route::get('/api_key', [ApiKeysController::class, 'index']);
    Route::post('/subscribe', [SubscribersController::class, 'store']);
    Route::get('/subscribe', [SubscribersController::class, 'index']);
});
