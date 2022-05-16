<?php

use App\Http\Controllers\Api\AppealController;
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

Route::apiResource('news',controller: \App\Http\Controllers\Api\NewsApiController::class)->only([
   'index',
   'show'
]);

Route::apiResource('page',controller: \App\Http\Controllers\Api\PageController::class)->only([
    'index',
    'show'
]);

Route::post('appeal', [AppealController::class, 'send'])->name('appeal.api.send');
