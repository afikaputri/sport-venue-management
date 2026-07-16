<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\CourtTypeController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\EquipmentRentalController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\TournamentParticipantController;

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
    Route::resource('bookings', BookingController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('equipment_rentals', EquipmentRentalController::class);
    Route::resource('tournaments', TournamentController::class);
    Route::resource('tournament_participants', TournamentParticipantController::class);

    Route::get('/reports/summary', [App\Http\Controllers\ReportController::class, 'summary'])->name('reports.summary');
    Route::get('/reports/booking', [App\Http\Controllers\ReportController::class, 'booking'])->name('reports.booking');
    Route::get('/reports/payment', [App\Http\Controllers\ReportController::class, 'payment'])->name('reports.payment');
});
