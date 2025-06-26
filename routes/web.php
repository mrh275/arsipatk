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
Route::get('admin/transaksi/permintaan/hapus/{id}', [PermintaanController::class, 'hapusPermintaan']);
Route::get('admin/transaksi/get-permintaan/{id}', [PermintaanController::class, 'editPermintaan']);
Route::post('admin/transaksi/update-permintaan', [PermintaanController::class, 'updatePermintaan']);
Route::get('admin/transaksi/data-penerimaan', [PenerimaanController::class, 'index']);
Route::get('admin/transaksi/tambah-penerimaan', [PenerimaanController::class, 'tambahPenerimaan']);
Route::post('admin/transaksi/tambah-penerimaan', [PenerimaanController::class, 'simpanPenerimaan']);
Route::get('admin/transaksi/penerimaan/hapus/{id}', [PenerimaanController::class, 'hapusPenerimaan']);
Route::get('admin/transaksi/get-penerimaan/{id}', [PenerimaanController::class, 'editPenerimaan']);
Route::post('admin/transaksi/update-penerimaan', [PenerimaanController::class, 'updatePenerimaan']);
