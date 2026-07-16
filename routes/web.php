<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\CourtTypeController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('venues', VenueController::class);
    Route::resource('court_types', CourtTypeController::class);
    Route::resource('courts', CourtController::class);
    Route::resource('members', MemberController::class);
});
