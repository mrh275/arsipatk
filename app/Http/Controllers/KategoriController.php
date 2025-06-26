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
            'dropdown' => 'master',
            'active' => 'kategori',
            'dataKategori' => $dataKategori,
            'hasDatatable' => '1',
        ];
        return view('admin.kategori.data-kategori', $data);
    }

    public function tambahKategori()
    {
        $data = [
            'title' => 'Tambah Kategori',
            'dropdown' => 'master',
            'active' => 'kategori',
            'hasDatatable' => '0',
        ];
        return view('admin.kategori.tambah-kategori', $data);
    }

    public function simpanKategori(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);
        $data['id_kategori'] = 'K' . time(); // Generate unique ID for the category
        $data['slug_kategori'] = $this->makeSlug($data['nama_kategori'], '-'); // Create a slug from the category name
        $result = Kategori::create($data);

        if (!$result) {
            return redirect('admin/master/kategori')->with('error', 'Kategori gagal ditambahkan.');
        }

        return redirect('admin/master/kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function hapusKategori($id)
    {
        $kategori = Kategori::where('id_kategori', $id);
        $result = $kategori->delete();

        if (!$result) {
            return redirect('admin/master/kategori')->with('error', 'Kategori gagal dihapus.');
        }

        return redirect('admin/master/kategori')->with('success', 'Kategori berhasil dihapus.');
    }

    public function getKategori($id)
    {
        $kategori = Kategori::where('id_kategori', $id)->first();
        if (!$kategori) {
            return response()->json(['error' => 'Kategori tidak ditemukan'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $kategori,
            'message' => 'Kategori ditemukan'
        ]);
    }

    public function updateKategori(Request $request)
    {
        $data = $request->validate([
            'id_kategori' => 'required|string|max:255',
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = Kategori::where('id_kategori', $data['id_kategori'])->first();
        if (!$kategori) {
            return redirect('admin/master/kategori')->with('error', 'Kategori tidak ditemukan.');
        }

        $data['slug_kategori'] = $this->makeSlug($data['nama_kategori'], '-'); // Create a slug from the category name
        $result = $kategori->update($data);

        if (!$result) {
            return redirect('admin/master/kategori')->with('error', 'Kategori gagal diperbarui.');
        }

        return redirect('admin/master/kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    private function makeSlug($string, $separator = '-')
    {
        // Convert the string to lowercase and replace spaces with the separator
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', $separator, $string)));
    }
}
