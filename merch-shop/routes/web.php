<?php

use App\Http\Controllers\Web\AppealController;
use App\Http\Controllers\Page\PageWebController;
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

Route::get('/appeal', [AppealController::class, 'form'])->name('appeal.form');
Route::post('/appeal',[AppealController::class, 'send'])->name('appeal.send');

Route::get('/news', [NewsController::class, 'index']);

Route::get('/{slug}', PageWebController::class);
Route::get('/news/{slug}', [NewsController::class, 'show']);
