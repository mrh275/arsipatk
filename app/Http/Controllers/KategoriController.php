<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $dataKategori = Kategori::all();
        $data = [
            'title' => 'Kategori',
            'active' => 'kategori',
            'dataKategori' => $dataKategori,
            'hasDatatable' => '1',
        ];
        return view('admin.kategori.data-kategori', $data);
    }
}
