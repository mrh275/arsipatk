<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanController;
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
Route::get('admin/master/tambah-kategori', [KategoriController::class, 'tambahKategori']);
Route::post('admin/master/tambah-kategori', [KategoriController::class, 'simpanKategori']);
Route::get('admin/master/kategori/hapus/{id}', [KategoriController::class, 'hapusKategori']);
Route::get('admin/master/kategori/{id}', [KategoriController::class, 'getKategori']);
Route::post('admin/master/kategori/update', [KategoriController::class, 'updateKategori']);
Route::get('admin/master/barang', [BarangController::class, 'index']);
Route::get('admin/master/tambah-barang', [BarangController::class, 'tambahBarang']);
Route::post('admin/master/tambah-barang', [BarangController::class, 'simpanBarang']);
Route::get('admin/master/barang/hapus/{id}', [BarangController::class, 'hapusBarang']);
Route::get('admin/master/barang/{id}', [BarangController::class, 'getBarang']);
Route::post('admin/master/barang/update', [BarangController::class, 'updateBarang']);

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

// Route untuk Laporan
Route::get('admin/laporan/persediaan', [LaporanController::class, 'laporanPersediaan']);
Route::post('admin/laporan/persediaan', [LaporanController::class, 'cetakLaporanPersediaan']);
Route::get('admin/laporan/permintaan', [LaporanController::class, 'laporanPermintaan']);
Route::get('admin/laporan/penerimaan', [LaporanController::class, 'laporanPenerimaan']);
