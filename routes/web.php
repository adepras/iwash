<?php

use App\Models\Booking;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ForgotPasswordController;

// Halaman Website
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu-layanan', [MenuController::class, 'menu'])->name('menu');
Route::get('/harga', [HomeController::class, 'price'])->name('price');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');

// Lupa Password
Route::get('forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['guest'])->group(function () {
    // Login & Register
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware(['auth'])->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit_profile'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Pemesanan Layanan
    Route::get('/satu-kali-cuci', [MenuController::class, 'menu1'])->name('menu1');
    Route::get('/salon-mobil', [MenuController::class, 'menu2'])->name('menu2');

    // Order
    Route::post('/order', [MenuController::class, 'createBooking'])->name('order');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/detail_order/{id}', [BookingController::class, 'show'])->name('detail_order');
    Route::get('/order/{id}', [BookingController::class, 'show'])->name('order.detail');
    Route::get('/detail-pemesanan', [BookingController::class, 'createBooking'])->name('createBooking');


    // Route::get('/detail_order', function () {
    //     $booking = Booking::where('user_id', auth()->id())->latest()->first();
    //     return view('detail_order', compact('booking'));
    // })->name('detail_order');

    // // Detail Pemesanan
    // Route::get('/detail-pemesanan', [MenuController::class, 'detail_order'])->name('detail_order');

    
});

// Admin
Route::get('/admin', [AdminController::class, 'admin'])->name('admin');

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin
    Route::get('/admin-profile', [AdminController::class, 'adminprofile'])->name('admin.adminprofile');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/booking', [AdminController::class, 'booking'])->name('admin.booking');
    Route::get('/queue', [AdminController::class, 'queue'])->name('admin.queue');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});
