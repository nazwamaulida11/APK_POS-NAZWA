<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemPenjualanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Transaksi (Admin & Kasir)
    Route::middleware('role:admin,kasir')->group(function () {
        Route::resource('penjualan', PenjualanController::class)->except('show');
        Route::get('/penjualan/{penjualan}', [PenjualanController::class, 'show'])->name('penjualan.show');
        Route::resource('itempenjualan', ItemPenjualanController::class)->except(['index', 'show', 'create', 'edit']);
    });

    // Master Data dengan Prefix Admin
    Route::prefix('admin')->name('admin.')->group(function () {

        // Fitur Produk (Bisa diakses Admin & Kasir)
        Route::middleware('role:admin,kasir')->group(function () {
            Route::resource('produk', ProdukController::class)->except('show');
        });

        // Fitur Khusus Admin (Users & Jenis)
        Route::middleware('role:admin')->group(function () {
            Route::resource('users', UserController::class);
            Route::resource('jenis', JenisController::class)->parameters([
                'jenis' => 'jenis'
            ]);
        });

    });

});