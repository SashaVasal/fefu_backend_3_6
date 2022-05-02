<?php

use App\Http\Controllers\NewsApiController;
use App\Http\Controllers\PageWebController;
use App\Http\Controllers\AppealController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/appeal', [AppealController::class, 'form'])->name('appeal.form');
Route::post('/appeal',[AppealController::class, 'send'])->name('appeal.send');

Route::get('/news', [NewsApiController::class, 'index']);

Route::get('/{slug}', PageWebController::class);
Route::get('/news/{slug}', [NewsApiController::class, 'show']);
