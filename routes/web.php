<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[PerformanceController::class,'index'])->name('home');
Route::get('/performance/all', [PerformanceController::class, 'all'])->name('performance.all');
Route::get('/company/all', [CompanyController::class, 'all'])->name('company.all');
Route::get('/performance/{id}', [PerformanceController::class, 'show'])->name('performance');
Route::get('/company/{id}', [CompanyController::class , 'index'])->name('company');
Route::get('/search', [PerformanceController::class, 'search'])->name('search');

Route::middleware(['auth'])->group(function () {
  Route::post('/reservation/confirm', [ReservationController::class, 'create'])->name('reserve.confirm');
  Route::post('/reservation', [ReservationController::class, 'store'])->name('reserve.store');
  Route::post('/reservation/{id}', [ReservationController::class, 'destroy'])->name('reserve.destroy');
  Route::get('/reservation/thanks', [ReservationController::class, 'index'])->name('reserve.thanks');
  Route::get('/mypage', [UserController::class, 'index'])->name('mypage');
  Route::get('/user/edit', [UserController::class, 'edit'])->name('mypage.edit');
  Route::put('/user/edit', [UserController::class, 'update'])->name('mypage.update');
  Route::get('/user/password', [UserController::class, 'editPassword'])->name('password.edit');
  Route::post('/user/password', [UserController::class, 'updatePassword'])->name('password.update');
  Route::post('/favorite', [FavoriteController::class, 'add'])->name('favorite.on');
  Route::post('/favorite/{id}', [FavoriteController::class, 'delete'])->name('favorite.off');
});

Route::middleware(['auth', 'can:admin_or_owner'])->group(function () {
  Route::post('/performance/delete', [PerformanceController::class, 'delete'])->name('performance.delete');
});

Route::middleware(['auth', 'can:owner'])->group(function () {
  Route::get('/owner', [UserController::class, 'owner'])->name('owner');
  Route::get('/admin/create/performance', [PerformanceController::class, 'create'])->name('performance.create');
  Route::post('/admin/create/performance/confirm', [PerformanceController::class, 'confirm'])->name('performance.confirm');
  Route::post('/admin/create/date', [DateController::class, 'create'])->name('date.create');
  Route::post('/admin/create/performance/store', [PerformanceController::class, 'store'])->name('performance.store');
}); 

Route::middleware(['auth', 'can:admin'])->group(function () {
  Route::get('admin', [UserController::class,'admin'])->name('admin');
  Route::get('/admin/create/user', [UserController::class, 'create'])->name('admin.create');
  Route::post('/admin/create/user', [UserController::class, 'store'])->name('admin.user');
  Route::post('/admin/create/company', [CompanyController::class, 'store'])->name('admin.company');
});


require __DIR__.'/auth.php';
