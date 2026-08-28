<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemPenjualanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('role:admin,kasir')->group(function () {
        // Resource route (termasuk /penjualan/create, /penjualan/{id}/edit, dll) didaftarkan DULUAN
        Route::resource('penjualan', PenjualanController::class)->except('show');

        // Baru route custom show dengan wildcard {penjualan} didaftarkan SETELAHNYA
        Route::get('/penjualan/{penjualan}', [PenjualanController::class, 'show'])->name('penjualan.show');

        Route::resource('itempenjualan', ItemPenjualanController::class)->except(['index', 'show', 'create', 'edit']);
    });

    // Produk: bisa diakses admin & kasir, tapi tetap pakai prefix/name 'admin.'
    Route::middleware('role:admin,kasir')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('produk', ProdukController::class)->except('show');
    });

    // Users: khusus admin
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::resource('jenis', JenisController::class)->parameters([
            'jenis' => 'jenis'
        ]);
    });

});