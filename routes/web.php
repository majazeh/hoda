<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');

Route::prefix('dashboard')->middleware('auth')->group(function(){
});
