<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('members', App\Http\Controllers\memberController::class);
Route::resource('courts', App\Http\Controllers\courtController::class);
Route::resource('bookings', App\Http\Controllers\bookingController::class);

require __DIR__.'/auth.php';