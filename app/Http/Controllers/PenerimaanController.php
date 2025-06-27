<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penerimaan;
use Illuminate\Http\Request;

class PenerimaanController extends Controller
{
    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!session()->has('username')) {
            return redirect('/')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Logika untuk menampilkan data penerimaan

        $dataPenerimaan = Penerimaan::with('barang')->get();
        $dataBarang = Barang::all(); // Ambil semua data barang untuk dropdown
        $data = [
            'title' => 'Data Penerimaan',
            'dropdown' => 'transaksi',
            'active' => 'penerimaan',
            'dataPenerimaan' => $dataPenerimaan,
            'dataBarang' => $dataBarang,
            'hasDatatable' => '1',

        ];

        // dd($dataPenerimaan); // Debugging line to check the data
        return view('admin.penerimaan.data-penerimaan', $data);
    }

    public function tambahPenerimaan()
    {
        // Cek apakah pengguna sudah login
        if (!session()->has('username')) {
            return redirect('/')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Logika untuk menampilkan form tambah permintaan
        $dataBarang = Barang::all(); // Ambil semua data barang untuk dropdown
        $data = [
            'title' => 'Tambah Penerimaan',
            'dropdown' => 'transaksi',
            'active' => 'penerimaan',
            'hasDatatable' => '0',
            'dataBarang' => $dataBarang,
        ];
        return view('admin.penerimaan.tambah-penerimaan', $data);
    }

    public function simpanPenerimaan(Request $request)
    {
        // Logika untuk menambahkan penerimaan baru
        // dd($request->all()); // Debugging line to check the request data
        $barang = Barang::where('id_barang', $request->id_barang);
        $dataBarang = $barang->first();
        $validatedData = $request->validate([
            'id_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
        ]);

        $validatedData['id_penerimaan'] = 'TRX-I-' . time(); // Generate unique ID for the request
        $validatedData['tanggal_penerimaan'] = now(); // Set the current date and time
        $validatedData['satuan_barang'] = $dataBarang->satuan_barang; // Set the unit of the item
        $validatedData['keterangan'] = $request->keterangan ?? ''; // Optional field

        // dd($validatedData);
        $result = Penerimaan::create($validatedData);
        if (!$result) {
            return redirect()->back()->with('error', 'Gagal menambahkan data penerimaan.');
        }
        $barang->update([
            'stok_barang' => $dataBarang->stok_barang + $validatedData['jumlah']
        ]);

        return redirect()->to('admin/transaksi/data-penerimaan')->with('success', 'Data penerimaan berhasil ditambahkan.');
    }

    public function hapusPenerimaan($id)
    {
        // Logika untuk menghapus penerimaan berdasarkan ID
        $penerimaan = Penerimaan::where('id_penerimaan', $id)->first();
        $result = $penerimaan->delete();

        if (!$result) {
            return redirect()->back()->with('error', 'Gagal menghapus data penerimaan.');
        }
        $barang = Barang::where('id_barang', $penerimaan->id_barang)->first();
        $barang->update([
            'stok_barang' => $barang->stok_barang - $penerimaan->jumlah
        ]);

        return redirect()->to('admin/transaksi/data-penerimaan')->with('success', 'Data permintaan berhasil dihapus.');
    }

    public function editPenerimaan($id)
    {
        // Logika untuk mengedit penerimaan
        $penerimaan = Penerimaan::where('id_penerimaan', $id)->first();

        if (!$penerimaan) {
            return response()->json(['error' => 'Data penerimaan tidak ditemukan.'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data penerimaan berhasil ditemukan.',
            'data' => $penerimaan
        ]);
    }

    public function updatePenerimaan(Request $request)
    {
        // Logika untuk memperbarui penerimaan
        $barang = Barang::where('id_barang', $request->id_barang);
        $dataBarang = $barang->first();
        $validatedData = $request->validate([
            'id_penerimaan' => 'required|string|max:255',
            'id_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
        ]);

        $penerimaan = Penerimaan::where('id_penerimaan', $validatedData['id_penerimaan'])->first();

        if (!$penerimaan) {
            return response()->json(['error' => 'Data penerimaan tidak ditemukan.'], 404);
        }

        $validatedData['tanggal_penerimaan'] = now(); // Update the date to current time
        $validatedData['satuan_barang'] = $dataBarang->satuan_barang; // Update the unit of the item
        $result = $penerimaan->update($validatedData);

        if (!$result) {
            return redirect()->back()->with('error', 'Gagal memperbarui data penerimaan.');
        }

        return redirect()->to('admin/transaksi/data-penerimaan')->with('success', 'Data penerimaan berhasil diperbarui.');
    }
}
