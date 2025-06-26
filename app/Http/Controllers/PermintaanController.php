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
        $dataBarang = Barang::all(); // Ambil semua data barang untuk dropdown
        $data = [
            'title' => 'Data Permintaan',
            'dropdown' => 'transaksi',
            'active' => 'permintaan',
            'dataPermintaan' => $dataPermintaan,
            'dataBarang' => $dataBarang,
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
        $result = Permintaan::create($validatedData);
        if (!$result) {
            return redirect()->back()->with('error', 'Gagal menambahkan permintaan.');
        }
        // Update the stock of the requested item
        $barang = Barang::where('id_barang', $validatedData['id_barang'])->first();
        if ($barang) {
            $barang->update([
                'stok_barang' => $barang->stok_barang - $validatedData['jumlah_permintaan']
            ]);
        } else {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        return redirect()->to('admin/transaksi/data-permintaan')->with('success', 'Permintaan berhasil ditambahkan.');
    }

    public function hapusPermintaan($id)
    {
        // Logika untuk menghapus permintaan berdasarkan ID
        $permintaan = Permintaan::where('id_permintaan', $id)->first();
        $result = $permintaan->delete();

        if (!$result) {
            return redirect()->back()->with('error', 'Gagal menghapus permintaan.');
        }
        // Update the stock of the requested item
        $barang = Barang::where('id_barang', $permintaan->id_barang)->first();
        if ($barang) {
            $barang->update([
                'stok_barang' => $barang->stok_barang + $permintaan->jumlah_permintaan
            ]);
        } else {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        return redirect()->to('admin/transaksi/data-permintaan')->with('success', 'Permintaan berhasil dihapus.');
    }

    public function editPermintaan($id)
    {
        // Logika untuk mengedit permintaan
        $permintaan = Permintaan::where('id_permintaan', $id)->first();

        if (!$permintaan) {
            return response()->json(['error' => 'Permintaan tidak ditemukan.'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Permintaan berhasil ditemukan.',
            'data' => $permintaan
        ]);
    }

    public function updatePermintaan(Request $request)
    {

        // Logika untuk memperbarui permintaan
        $validatedData = $request->validate([
            'id_permintaan' => 'required|string|max:255',
            'issued_by' => 'required|string|max:255',
            'id_barang' => 'required|string|max:255',
            'jumlah_permintaan' => 'required|integer|min:1',
        ]);

        $permintaan = Permintaan::where('id_permintaan', $validatedData['id_permintaan'])->first();

        if (!$permintaan) {
            return response()->json(['error' => 'Permintaan tidak ditemukan.'], 404);
        }

        $validatedData['tanggal_permintaan'] = now(); // Update the date to current time
        $validatedData['status_permintaan'] = $permintaan->status_permintaan; // Reset status to pending

        $result = $permintaan->update($validatedData);

        if (!$result) {
            return redirect()->back()->with('error', 'Gagal memperbarui permintaan.');
        }

        return redirect()->to('admin/transaksi/data-permintaan')->with('success', 'Permintaan berhasil diperbarui.');
    }
}
