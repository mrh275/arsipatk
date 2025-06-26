<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Permintaan;
use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan data permintaan

        $dataPermintaan = Permintaan::with('barang')->get();
        $data = [
            'title' => 'Data Permintaan',
            'dropdown' => 'transaksi',
            'active' => 'permintaan',
            'dataPermintaan' => $dataPermintaan,
            'hasDatatable' => '1',

        ];

        // dd($dataPermintaan); // Debugging line to check the data
        return view('admin.permintaan.data-permintaan', $data);
    }

    public function tambahPermintaan()
    {
        // Logika untuk menampilkan form tambah permintaan
        $dataBarang = Barang::all(); // Ambil semua data barang untuk dropdown
        $data = [
            'title' => 'Tambah Permintaan',
            'dropdown' => 'transaksi',
            'active' => 'permintaan',
            'hasDatatable' => '0',
            'dataBarang' => $dataBarang,
        ];
        return view('admin.permintaan.tambah-permintaan', $data);
    }

    public function simpanPermintaan(Request $request)
    {
        // Logika untuk menambahkan permintaan baru
        // dd($request->all()); // Debugging line to check the request data
        $validatedData = $request->validate([
            'issued_by' => 'required|string|max:255',
            'id_barang' => 'required|string|max:255',
            'jumlah_permintaan' => 'required|integer|min:1',
        ]);

        $validatedData['id_permintaan'] = 'PMT-' . time(); // Generate unique ID for the request
        $validatedData['tanggal_permintaan'] = now(); // Set the current date and time
        $validatedData['status_permintaan'] = 'pending'; // Default status

        // dd($validatedData);
        Permintaan::create($validatedData);

        return redirect()->to('admin/transaksi/data-permintaan')->with('success', 'Permintaan berhasil ditambahkan.');
    }

    public function hapusPermintaan($id)
    {
        // Logika untuk menghapus permintaan berdasarkan ID
        $permintaan = Permintaan::where('id_permintaan', $id)->first();
        $permintaan->delete();

        return redirect()->to('admin/transaksi/data-permintaan')->with('success', 'Permintaan berhasil dihapus.');
    }
}
