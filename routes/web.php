<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;

Route::get('/', [PerformanceController::class, 'index'])->name('home');
Route::get('/performance/all', [PerformanceController::class, 'all'])->name('performance.all');
Route::get('/company/all', [CompanyController::class, 'all'])->name('company.all');
Route::get('/performance/{id}', [PerformanceController::class, 'show'])->name('performance');
Route::get('/company/{id}', [CompanyController::class, 'index'])->name('company');
Route::get('/search', [PerformanceController::class, 'search'])->name('search');

Route::middleware(['verified'])->group(function () {
  Route::post('/reservation/confirm', [ReservationController::class, 'create'])->name('reserve.confirm');
  Route::get('/reservation/thanks', [ReservationController::class, 'index'])->name('reserve.thanks');
  Route::post('/reservation/{id}', [ReservationController::class, 'destroy'])->name('reserve.destroy');
  Route::post('/reservation', [ReservationController::class, 'store'])->name('reserve.store');
  Route::get('/mypage', [UserController::class, 'index'])->name('mypage');
  Route::get('/user/edit', [UserController::class, 'edit'])->name('mypage.edit');
  Route::put('/user/edit', [UserController::class, 'update'])->name('mypage.update');
  Route::get('/user/password', [UserController::class, 'editPassword'])->name('password.edit');
  Route::post('/user/password', [UserController::class, 'updatePassword'])->name('password.update');
  Route::post('/favorite', [FavoriteController::class, 'add'])->name('favorite.on');
  Route::post('/favorite/{id}', [FavoriteController::class, 'delete'])->name('favorite.off');

  Route::prefix('admin')->group(function(){
    Route::middleware(['can:admin_or_owner'])->group(function () {
      Route::post('/performance/delete', [PerformanceController::class, 'delete'])->name('performance.delete');
      Route::get('/performance/edit', [PerformanceController::class, 'edit'])->name('performance.edit');
      Route::post('/performance/edit', [PerformanceController::class, 'update'])->name('performance.update');
      Route::get('/company/edit', [CompanyController::class, 'edit'])->name('company.edit');
      Route::post('/company/edit', [CompanyController::class, 'update'])->name('company.update');
      Route::get('performance/date', [DateController::class, 'edit'])->name('date.edit');
      Route::post('performance/date', [DateController::class, 'delete'])->name('date.delete');
      Route::post('performance/date/add', [DateController::class, 'add'])->name('date.add');
    });
    
    Route::middleware(['can:owner'])->group(function () {
      Route::get('/owner', [UserController::class, 'owner'])->name('owner');
      Route::get('/performance/create', [PerformanceController::class, 'create'])->name('performance.create');
      Route::post('/performance/confirm', [PerformanceController::class, 'confirm'])->name('performance.confirm');
      Route::post('/date/create', [DateController::class, 'create'])->name('date.create');
      Route::post('/performance/create', [PerformanceController::class, 'store'])->name('performance.store');
  });
    
    Route::middleware(['can:admin'])->group(function () {
      Route::get('/', [UserController::class, 'admin'])->name('admin');
      Route::get('/user/create', [UserController::class, 'create'])->name('admin.create');
      Route::post('/user/create', [UserController::class, 'store'])->name('admin.user');
      Route::post('/company/create', [CompanyController::class, 'store'])->name('admin.company');
      Route::post('/company/delete', [CompanyController::class, 'delete'])->name('company.delete');
    });
  });
});

require __DIR__ . '/auth.php';
