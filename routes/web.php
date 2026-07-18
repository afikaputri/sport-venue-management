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
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    // Semua Role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Khusus Member
    Route::middleware('role:member')->group(function () {
        Route::get('/member-portal/venues', [App\Http\Controllers\MemberPortalController::class, 'venues'])->name('member.venues');
        Route::get('/member-portal/venues/{id}', [App\Http\Controllers\MemberPortalController::class, 'venueDetail'])->name('member.venues.show');
        Route::get('/member-portal/courts/{id}', [App\Http\Controllers\MemberPortalController::class, 'courtDetail'])->name('member.courts.show');
        Route::get('/member-portal/bookings', [App\Http\Controllers\MemberPortalController::class, 'bookings'])->name('member.bookings');
        Route::get('/member-portal/bookings/create', [App\Http\Controllers\MemberPortalController::class, 'createBooking'])->name('member.bookings.create');
        Route::post('/member-portal/bookings', [App\Http\Controllers\MemberPortalController::class, 'storeBooking'])->name('member.bookings.store');
        Route::get('/member-portal/payments', [App\Http\Controllers\MemberPortalController::class, 'payments'])->name('member.payments');
        Route::get('/member-portal/payments/create/{booking_id}', [App\Http\Controllers\MemberPortalController::class, 'createPayment'])->name('member.payments.create');
        Route::post('/member-portal/payments/{booking_id}', [App\Http\Controllers\MemberPortalController::class, 'storePayment'])->name('member.payments.store');
    });

    // Khusus Staff (Operasional)
    Route::middleware('role:staff')->group(function () {
        Route::patch('bookings/{booking}/status', [App\Http\Controllers\BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
        Route::patch('payments/{payment}/verify', [App\Http\Controllers\PaymentController::class, 'verifyPayment'])->name('payments.verify');
        Route::resource('members', MemberController::class);
        Route::resource('bookings', BookingController::class);
        Route::resource('payments', PaymentController::class);
        // Route::resource('equipment_rentals', EquipmentRentalController::class);
    });

    // Khusus Staff dan Owner
    // Route::middleware('role:staff,owner')->group(function () {
    //     Route::resource('tournaments', TournamentController::class);
    //     Route::resource('tournament_participants', TournamentParticipantController::class);
    // });

    // Khusus Owner
    Route::middleware('role:owner')->group(function () {
        Route::resource('venues', VenueController::class);
        Route::resource('court_types', CourtTypeController::class);
        Route::resource('courts', CourtController::class);
        

        Route::get('/reports/booking', [App\Http\Controllers\ReportController::class, 'booking'])->name('reports.booking');
        Route::get('/reports/payment', [App\Http\Controllers\ReportController::class, 'payment'])->name('reports.payment');

        Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
    });
});
