<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\admin\SppController as AdminSppController;
use App\Http\Controllers\admin\AuthController as AdminAuthController;
use App\Http\Controllers\admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('data-siswa', AdminSiswaController::class)
        ->parameters(['data-siswa' => 'nis'])
        ->names('admin.data-siswa');
    Route::get('data-spp', [AdminSppController::class, 'index'])->name('admin.data-spp.index');
    Route::delete('data-spp/{id}', [AdminSppController::class, 'destroy'])->name('admin.data-spp.destroy');
    Route::put('data-spp/{id}/status', [AdminSppController::class, 'updateStatus'])->name('admin.data-spp.status');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

//Siswa
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/detail/{id}', [DashboardController::class, 'detail'])->name('detail');
    Route::post('dashboard/detail/{id}/bayar', [DashboardController::class, 'bayar'])->name('detail.bayar');
});

Route::get('/', function () {
    return view('welcome');
});
// user
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('prosesLogin', [AuthController::class, 'login'])->name('prosesLogin');
Route::post('register', [AuthController::class, 'store'])->name('register.store');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'showRegister'])->name('register');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


// admin
Route::get('admin', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.prosesLogin');
