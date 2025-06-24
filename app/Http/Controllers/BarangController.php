<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $dataBarang = Barang::with('kategori')->get();
        $data = [
            'title' => 'Data Barang',
            'dropdown' => 'master',
            'active' => 'barang',
            'dataBarang' => $dataBarang,
            'hasDatatable' => '1',
        ];

        return view('admin.barang.data-barang', $data);
    }
}
