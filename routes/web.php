<?php

use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/web/home');
});

// Admin Routes — dilindungi auth + is_admin
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('/admin/dashboard');
    })->name('admin.dashboard');

    Route::resource('/admin/menu', MenuController::class);
    Route::resource('/admin/meja', MejaController::class);
    Route::resource('/admin/reservasi', ReservasiController::class);
    Route::resource('/admin/user', UserController::class);
    Route::resource('/admin/review', ReviewController::class);
});

// Auth Routes
// GET /login — target for Laravel's auth middleware redirect (must be named 'login')
Route::get('/login', function () {
    return view('web.login');
})->name('login');

// Alias for links that still reference 'web.login'
Route::get('web/login', function () {
    return view('web.login');
})->name('web.login');

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('web/register', function () {
    return view('web/register');
})->name('web.register');

Route::post('/register', [UserController::class, 'register'])->name('register');

// Public Routes
Route::get('web/home', function () {
    return view('web/home');
})->name('web.home');

Route::get('web/menu', function () {
    return view('web/menu');
})->name('web.menu');

Route::get('web/about', function () {
    return view('web/about');
})->name('web.about');

// Protected Routes (butuh login)
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('web/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::put('web/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

    // Reservation
    Route::get('web/reservation', [ReservasiController::class, 'create'])->name('web.reservation.create');
    Route::post('web/reservation', [ReservasiController::class, 'store'])->name('web.reservation.store');
    Route::get('web/reservation/{reservasi}', [ReservasiController::class, 'show'])->name('web.reservation.show');
    Route::get('web/reservation/{id}/edit', [ReservasiController::class, 'edit'])->name('web.reservation.edit');
    Route::put('web/reservation/{reservasi}', [ReservasiController::class, 'update'])->name('web.reservation.update');
    Route::delete('web/reservation/{reservasi}', [ReservasiController::class, 'destroy'])->name('web.reservation.destroy');

    // Review
    Route::get('web/review', [ReviewController::class, 'create'])->name('web.review');
    Route::post('web/review', [ReviewController::class, 'store'])->name('review.store');
    Route::get('web/review/{id}', [ReviewController::class, 'show'])->name('review.show');
    Route::get('web/review/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit');
    Route::put('web/review/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('web/review/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
});
