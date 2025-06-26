<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PermintaanController;

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

Route::get('/', [LoginController::class, 'index']);
Route::get('admin/dashboard', [DashboardController::class, 'index']);

// Route untuk Master Data
Route::get('admin/master/kategori', [KategoriController::class, 'index']);
Route::get('admin/master/barang', [BarangController::class, 'index']);

// Route untuk Transaksi
Route::get('admin/transaksi/data-permintaan', [PermintaanController::class, 'index']);
Route::get('admin/transaksi/tambah-permintaan', [PermintaanController::class, 'tambahPermintaan']);
Route::post('admin/transaksi/tambah-permintaan', [PermintaanController::class, 'simpanPermintaan']);
Route::get('admin/transaksi/data-penerimaan', [PenerimaanController::class, 'index']);
Route::get('admin/transaksi/hapus/{id}', [PermintaanController::class, 'hapusPermintaan']);
