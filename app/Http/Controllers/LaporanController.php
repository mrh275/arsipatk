<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporanPersediaan()
    {

        $data = [
            'title' => 'Laporan Persediaan',
            'dropdown' => 'laporan',
            'active' => 'persediaan',
            'hasDatatable' => '0'
        ];

        return view('admin.laporan.persediaan', $data);
    }

    public function cetakLaporanPersediaan(Request $request)
    {
        // Logika untuk mencetak laporan persediaan
        // Misalnya, mengambil data dari database berdasarkan filter yang diberikan

        $format = $request->input('format_laporan');

        $dataBarang = Barang::with('kategori')->get(); // Ambil semua data barang

        // dd($dataBarang); // Debugging, bisa dihapus setelah selesai
        // Proses data dan cetak laporan sesuai format yang dipilih (PDF/Excel)
        $pdf = Pdf::loadView('admin.laporan.export.persediaan-pdf', [
            'dataBarang' => $dataBarang,
            'format' => $format
        ]);

        return $pdf->download('laporan_persediaan-barang.pdf');
    }
}
