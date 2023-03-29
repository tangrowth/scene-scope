<?php

use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\ReservationController;
use App\Models\Reservation;
use Illuminate\Support\Facades\Route;

Route::get('/',[PerformanceController::class,'index'])->name('home');
Route::get('/performance/{id}', [PerformanceController::class, 'show'])->name('performance');
Route::post('/reservation/confirm', [ReservationController::class,'create'])->name('reserve.confirm');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reserve.store');
Route::get('/reservation/thanks', [ReservationController::class, 'index'])->name('reserve.thanks');

require __DIR__.'/auth.php';
