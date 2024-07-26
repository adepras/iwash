<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

});

// Lupa Password
Route::get('forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Halaman Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu-layanan', [MenuController::class, 'menu'])->name('menu');
Route::get('/detailing', [HomeController::class, 'pack'])->name('pack');
Route::get('/harga', [HomeController::class, 'price'])->name('price');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');


Route::middleware(['auth'])->group(function () {
    // Profile dan Logout untuk User
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit_profile'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Menu Layanan Cuci Mobil
    Route::get('/satu-kali-cuci', [MenuController::class, 'menu1'])->name('menu1');
    Route::get('/salon-mobil', [MenuController::class, 'menu2'])->name('menu2');
    Route::get('/paket-super', [MenuController::class, 'menu3'])->name('menu3');

    // Menu Satu Kali Cuci
    Route::get('/menu-first', [MenuController::class, 'showWashPage'])->name('menu1');


});


// Admin
Route::get('/admin', [AdminController::class, 'admin'])->name('admin');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-profile', [AdminController::class, 'adminprofile'])->name('admin.adminprofile');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/booking', [AdminController::class, 'booking'])->name('admin.booking');
    Route::get('/queue', [AdminController::class, 'queue'])->name('admin.queue');
});
