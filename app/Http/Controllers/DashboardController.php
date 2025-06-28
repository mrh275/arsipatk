<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Penerimaan;
use App\Models\Permintaan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!session()->has('username')) {
            return redirect('/')->with('error', 'Anda harus login terlebih dahulu.');
        }
        $stokBarang = Barang::all();
        $kategoriBarang = Kategori::all();
        $dataPermintaan = Permintaan::all();
        $dataPenerimaan = Penerimaan::all();

        $data = [
            'title' => 'Dashboard',
            'dropdown' => 'dashboard',
            'active' => 'dashboard',
            'hasDatatable' => '0',
            'stokBarang' => $stokBarang->sum('stok_barang'),
            'kategoriBarang' => $kategoriBarang,
            'dataPermintaan' => $dataPermintaan,
            'dataPenerimaan' => $dataPenerimaan,
        ];

        return view('admin.dashboard', $data);
    }
}
