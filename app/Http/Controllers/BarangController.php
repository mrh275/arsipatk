<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $dataBarang = Barang::with('kategori')->get();
        $dataKategori = Kategori::all(); // Ambil semua data kategori untuk dropdown
        $data = [
            'title' => 'Data Barang',
            'dropdown' => 'master',
            'active' => 'barang',
            'dataBarang' => $dataBarang,
            'hasDatatable' => '1',
            'dataKategori' => $dataKategori,
        ];

        return view('admin.barang.data-barang', $data);
    }

    public function tambahBarang()
    {
        $dataKategori = Kategori::all();
        $data = [
            'title' => 'Tambah Barang',
            'dropdown' => 'master',
            'active' => 'barang',
            'hasDatatable' => '0',
            'dataKategori' => $dataKategori,
        ];
        return view('admin.barang.tambah-barang', $data);
    }

    public function simpanBarang(Request $request)
    {

        $data = $request->validate([
            'id_kategori' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'satuan_barang' => 'required|string|max:50',
        ]);

        $data['id_barang'] = 'B' . time(); // Generate unique ID for the item
        $data['slug_barang'] = $this->makeSlug($data['nama_barang'], '-'); // Create a slug from the item name
        $data['stok_barang'] = 0; // Initialize stock to 0

        $result = Barang::create($data);

        if (!$result) {
            return redirect('admin/master/barang')->with('error', 'Barang gagal ditambahkan.');
        }

        return redirect('admin/master/barang')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function hapusBarang($id)
    {
        $barang = Barang::where('id_barang', $id);
        $result = $barang->delete();

        if (!$result) {
            return redirect('admin/master/barang')->with('error', 'Barang gagal dihapus.');
        }

        return redirect('admin/master/barang')->with('success', 'Barang berhasil dihapus.');
    }

    public function getBarang($id)
    {
        $barang = Barang::with('kategori')->where('id_barang', $id)->first();
        if (!$barang) {
            return response()->json(['error' => 'Barang tidak ditemukan'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $barang,
            'message' => 'Barang ditemukan'
        ]);
    }

    public function updateBarang(Request $request)
    {
        $data = $request->validate([
            'id_barang' => 'required|string|max:255',
            'id_kategori' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'satuan_barang' => 'required|string|max:50',
        ]);

        $barang = Barang::where('id_barang', $data['id_barang'])->first();
        if (!$barang) {
            return redirect('admin/master/barang')->with('error', 'Barang tidak ditemukan.');
        }

        $data['slug_barang'] = $this->makeSlug($data['nama_barang'], '-'); // Create a slug from the item name
        $result = $barang->update($data);

        if (!$result) {
            return redirect('admin/master/barang')->with('error', 'Barang gagal diperbarui.');
        }

        return redirect('admin/master/barang')->with('success', 'Barang berhasil diperbarui.');
    }

    private function makeSlug($string, $separator = '-')
    {
        // Convert the string to lowercase and replace spaces with the separator
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', $separator, $string)));
        return $slug;
    }
}
