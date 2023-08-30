<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;

Route::get('/', [PerformanceController::class, 'index'])->name('home');
Route::get('/performance/all', [PerformanceController::class, 'all'])->name('performance.all');
Route::get('/performance/search', [PerformanceController::class, 'search'])->name('performance.search');
Route::get('/performance/{id}', [PerformanceController::class, 'show'])->name('performance');
Route::get('/company/all', [CompanyController::class, 'all'])->name('company.all');
Route::get('/company/search', [CompanyController::class, 'search'])->name('company.search');
Route::get('/company/{id}', [CompanyController::class, 'show'])->name('company');

Route::middleware(['verified'])->group(function () {
  Route::post('/reservation/confirm', [ReservationController::class, 'create'])->name('reserve.confirm');
  Route::get('/reservation/thanks', [ReservationController::class, 'thanks'])->name('reserve.thanks');
  Route::post('/reservation/cancel',[ReservationController::class, 'cancel'])->name('reserve.cancel');
  Route::post('/reservation/delete', [ReservationController::class, 'delete'])->name('reserve.delete');
  Route::post('/reservation', [ReservationController::class, 'store'])->name('reserve.store');

  Route::get('/QR/{id}', [QrCodeController::class, 'showQrCode'])->name('Qr.showQrCode');

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

      Route::get('/performance/date', [DateController::class, 'edit'])->name('date.edit');
      Route::post('/performance/date', [DateController::class, 'delete'])->name('date.delete');
      Route::post('/performance/date/update', [DateController::class, 'update'])->name('date.update');
      Route::post('/performance/date/add', [DateController::class, 'add'])->name('date.add');

      Route::get('/reserve/list/{id}', [ReservationController::class, 'show'])->middleware('check.date.access')->name('reserve.show');
      Route::get('/reserve/search/{id}', [ReservationController::class, 'search'])->middleware('check.date.access')->name('reserve.search');
      Route::get('/reserve', [ReservationController::class, 'index'])->name('reserve.menu');

      Route::get('/entry/QR/{id}', [QrCodeController::class, 'showReserve'])->name('Qr.showReserve');
      Route::post('/entry/{id}', [QrCodeController::class, 'entry'])->name('entry');
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
      Route::get('/create/user', [UserController::class, 'create'])->name('admin.create');
      Route::get('/create/company', [UserController::class, 'store'])->name('admin.user');
      Route::post('/create/confirm', [CompanyController::class, 'confirm'])->name('admin.confirm');
      Route::post('/create/complete', [CompanyController::class, 'store'])->name('admin.company');
      Route::post('/company/delete', [CompanyController::class, 'delete'])->name('company.delete');
    });
  });
});

require __DIR__ . '/auth.php';
