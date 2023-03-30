<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[PerformanceController::class,'index'])->name('home');
Route::get('/performance/{id}', [PerformanceController::class, 'show'])->name('performance');
Route::get('/company/{id}', [CompanyController::class , 'index'])->name('company');

Route::middleware(['auth'])->group(function () {
  Route::post('/reservation/confirm', [ReservationController::class, 'create'])->name('reserve.confirm');
  Route::post('/reservation', [ReservationController::class, 'store'])->name('reserve.store');
  Route::get('/reservation/thanks', [ReservationController::class, 'index'])->name('reserve.thanks');
  Route::get('/mypage', [UserController::class, 'index'])->name('mypage');
});
require __DIR__.'/auth.php';
