<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('merchandises', MerchandiseController::class);
Route::resource('users', UserController::class);
Route::resource('tickets', TicketController::class);
Route::resource('booking', BookingController::class);