<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('merchandises', MerchandiseController::class);
Route::resource('users', UserController::class);