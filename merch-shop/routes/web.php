<?php

use App\Http\Controllers\Web\AppealController;
use App\Http\Controllers\Web\NewsController;
use App\Http\Controllers\Web\PageWebController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\OAuthController;
use App\Http\Controllers\Web\CatalogController;

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

Route::get('/profile',[ProfileController::class,'show'])
    ->name('profile')
    ->middleware('auth');

Route::get('/register',[AuthController::class,'registerForm'])->name('register');
Route::post('/register',[AuthController::class,'register'])->name('register.post');

Route::get('/login',[AuthController::class,'loginForm'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.post');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');


Route::prefix('/oauth')->group(function () {
    Route::get('/{provider}/redirect', [OAuthController::class, 'redirectToService'])->name('oauth.redirect');
    Route::get('/{provider}/login', [OAuthController::class, 'login'])->name('oauth.login');
});

Route::get('/catalog/{slug?}', [CatalogController::class, 'index'])->name('catalog');

Route::get('/news/{slug}', [NewsController::class, 'show']);
Route::get('/{slug}', PageWebController::class);
