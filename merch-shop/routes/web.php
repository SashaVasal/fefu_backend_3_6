<?php

use App\Http\Controllers\Web\NewsController;
use App\Http\Controllers\Web\PageWebController;
use Illuminate\Support\Facades\Route;

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

Route::get('/news', [NewsController::class, 'index']);

Route::get('/{slug}', PageWebController::class);
Route::get('/news/{slug}', [NewsController::class, 'show']);
