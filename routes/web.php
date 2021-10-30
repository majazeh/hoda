<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');

Route::prefix('dashboard')->middleware('auth')->group(function(){
    Route::get(null, [\App\Http\Controllers\DashboardController::class, 'home'])->name('dashboard');
    Route::get('tasks/report', function() { return view('tasks.report');});
    Route::get('tasks/calendar', function() { return view('tasks.calendar.calendar');});
    Route::resource('tasks', \App\Http\Controllers\TaskController::class);
});
