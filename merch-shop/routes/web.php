<?php

use App\Http\Controllers\AppealController;
use App\Http\Controllers\NewsApiController;
use App\Http\Controllers\PageWebController;
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

Route::get('/news', [NewsApiController::class, 'index']);

Route::get('/profile',[ProfileController::class,'show'])
    ->name('profile')
    ->middleware('auth');

Route::get('/register',[AuthController::class,'registerForm'])->name('register');
Route::post('/register',[AuthController::class,'register'])->name('register.post');

Route::get('/login',[AuthController::class,'loginForm'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.post');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::get('/{slug}', PageWebController::class);
Route::get('/news/{slug}', [NewsApiController::class, 'show']);
