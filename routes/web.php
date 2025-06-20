<?php

use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Admin Routes
Route::resource('/admin/menu', MenuController::class);
Route::resource('/admin/meja', MejaController::class);
Route::resource('/admin/reservasi', ReservasiController::class);
Route::resource('/admin/user', UserController::class);
Route::resource('/admin/review', ReviewController::class);

Route::get('/', function () {
    return view('/web/home');
});

Route::get('/admin/dashboard', function () {
    return view('/admin/dashboard');
});

// Auth Routes
Route::get('web/login', function () {
    return view('web.login');
})->name('web.login');

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Register Routes
Route::get('web/register', function () {
    return view('web/register');
})->name('web/register');

Route::post('/register', [UserController::class, 'register'])->name('register');

Route::post('/register', [UserController::class, 'register'])->name('register');

// Home Routes
Route::get('web/home', function () {
    return view('web/home');
})->name('web.home');

// Menu Routes
Route::get('web/menu', function () {
    return view('web/menu');
});

// About Routes
Route::get('web/about', function () {
    return view('web/about');
});

// Profile Routes
Route::get('web/profile', function () {
    return view('web/profile');
});

// Review Routes
Route::get('web/review', function () {
    return view('web/review');
})->middleware('auth');

// Reservation Routes
// Reservation Routes dengan Middleware Auth
Route::middleware('auth')->group(function () {
    Route::get('web/reservation', [ReservasiController::class, 'create'])->name('web.reservation.create');
    Route::post('web/reservation', [ReservasiController::class, 'store'])->name('web.reservation.store');
    Route::get('web/reservation/{reservasi}', [ReservasiController::class, 'show'])->name('web.reservation.show');
    Route::get('web/reservation/{id}/edit', [ReservasiController::class, 'edit'])->name('web.reservation.edit');
    Route::put('web/reservation/{reservasi}', [ReservasiController::class, 'update'])->name('web.reservation.update');
    Route::delete('web/reservation/{reservasi}', [ReservasiController::class, 'destroy'])->name('web.reservation.destroy');
});



Route::get('web/profile', [ProfileController::class, 'profile'])->name('profile')->middleware('auth');
Route::put('web/profile/{id}', [ProfileController::class, 'update'])
     ->name('profile.update')
     ->middleware('auth');
Route::put('web/profile/{id}', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('web/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::put('web/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
});

// Review Routes
Route::middleware('auth')->group(function () {
    Route::get('web/review', [ReviewController::class, 'create'])->name('web.review');
    Route::post('web/review', [ReviewController::class, 'store'])->name('review.store');
    Route::get('web/review/{id}', [ReviewController::class, 'show'])->name('review.show');
    Route::get('web/review/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit');
    Route::put('/webreview/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('web/review/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');

});