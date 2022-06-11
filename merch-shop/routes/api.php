<?php

use App\Http\Controllers\Api\AppealController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CatalogController;
use App\Http\Controllers\Api\ProductController;
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
Route::get('/catalog/product/list', [ProductController::class, 'index']);
Route::get('/catalog/product/details/{slug}', [ProductController::class, 'show']);

Route::get('/catalog/', [CatalogController::class, 'index'])->name('catalog');
Route::get('/catalog/{slug?}', [CatalogController::class, 'show'])->name('list');



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

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('register', [AuthController::class, 'register']);
