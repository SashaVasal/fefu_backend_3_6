<?php

use App\Http\Controllers\NewsApiController;
use App\Http\Controllers\PageWebController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AppealController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/appeal', [AppealController::class, 'form'])->name('appeal.form');
Route::post('/appeal',[AppealController::class, 'send'])->name('appeal.send');
Route::get('/news', [NewsApiController::class, 'index']);
Route::get('/{slug}', PageWebController::class);
Route::get('/news/{slug}', [NewsApiController::class, 'show']);
