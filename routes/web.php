<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\GalleryController;


// Homepagenya
Route::get('/', function () {
    return redirect()->route('home');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');


// Ini riwayat pemesanannya 
Route::get('/riwayat-pemesanan', [RiwayatController::class, 'index'])->name('riwayat.index');

// bagian customer servicenya 
Route::get('/customer-service', [CustomerServiceController::class, 'index'])->name('customer-service.index');

// ini untuk pengguna yang dimana ada register login dan forgot passwordnya
Route::get('/register', [PenggunaController::class, 'register'])->name('pengguna.register');
Route::post('/register', [PenggunaController::class, 'prosesRegister'])->name('pengguna.prosesRegister');

Route::get('/login', [PenggunaController::class, 'login'])->name('pengguna.login');
Route::post('/login', [PenggunaController::class, 'prosesLogin'])->name('pengguna.prosesLogin');

Route::get('/forgot-password', [PenggunaController::class, 'forgotPassword'])->name('pengguna.forgotPassword');
Route::post('/forgot-password', [PenggunaController::class, 'prosesForgotPassword'])->name('pengguna.prosesForgotPassword');

// ada juga logoutnya 
Route::post('/logout', [PenggunaController::class, 'logout'])->name('pengguna.logout');

// ini untuk schedulenya di perbaru routerrnya
Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');

Route::resource('tickets', TicketController::class);
Route::resource('booking', BookingController::class);
Route::resource('pengguna', PenggunaController::class);
Route::resource('customer-service', CustomerServiceController::class);
Route::resource('concerts', ConcertController::class);
Route::resource('artists', ArtistController::class);
Route::resource('wishlist', WishlistController::class);
Route::resource('venues', VenueController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('payments', PaymentController::class);
Route::resource('galleries', GalleryController::class);
?>