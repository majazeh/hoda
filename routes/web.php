<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');

Route::prefix('dashboard')->middleware('auth')->group(function(){
    Route::get(null, [\App\Http\Controllers\DashboardController::class, 'home'])->name('dashboard');
    Route::get('logout', function(Request $request){
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    });
    Route::get('tasks/report', [\App\Http\Controllers\TaskController::class, 'report'])->name('tasks.report');
    Route::get('calendar/daily', [\App\Http\Controllers\CalendarController::class, 'daily'])->name('calendar.daily');
    Route::get('calendar/weekly', [\App\Http\Controllers\CalendarController::class, 'weekly'])->name('calendar.weekly');
    Route::get('calendar/monthly', [\App\Http\Controllers\CalendarController::class, 'monthly'])->name('calendar.monthly');
    Route::get('calendar/yearly', [\App\Http\Controllers\CalendarController::class, 'yearly'])->name('calendar.yearly');
    Route::resource('tasks', \App\Http\Controllers\TaskController::class);
    Route::post('/reports/{task}', [\App\Http\Controllers\TaskController::class, 'reportStore']);
    Route::resource('users', \App\Http\Controllers\UserController::class);
});
