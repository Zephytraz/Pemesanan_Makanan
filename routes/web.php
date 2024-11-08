<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailLoginController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\ListUserController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\MakananFavoritController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\UlasanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// middleware admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function(){
    Route::resource('/category', CategoryController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('/makanan', MakananController::class)->except('index', 'show');

    Route::resource('/listUser', ListUserController::class)->only('index', 'destroy');
    Route::get('/loginlogs', [DetailLoginController::class, 'index'])->name('loginlogs.index');
});


// middleware user
Route::middleware(['auth', 'role:user'])->prefix('/user')->group(function(){
    // ulasan
    Route::resource('/ulasan', UlasanController::class)->except('index', 'show');
    Route::resource('/makananfavorit', MakananFavoritController::class)->except( 'index', 'show', 'edit', 'create');
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
    Route::get('/detail-transaksi', [DetailTransaksiController::class, 'index'])->name('detail.transaksi');
});


Route::middleware('auth')->group(function () {
    // makanan
    Route::resource('/makanan', MakananController::class)->only('index', 'show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // ulasan
    Route::resource('/ulasan', UlasanController::class)->only('index', 'show');
    // makanan favorit
    Route::resource('/makananfavorit', MakananFavoritController::class)->only('index');

    Route::post('/profile/saldo', [SaldoController::class, 'update'])->name('saldo.update');
 
});
require __DIR__.'/auth.php';
