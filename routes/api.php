<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AddressController;

Route::get('/address/{zip}', [AddressController::class, 'address']);