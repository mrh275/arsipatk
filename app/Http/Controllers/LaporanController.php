<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penerimaan;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function laporanPersediaan()
    {

        $data = [
            'title' => 'Laporan Persediaan',
            'dropdown' => 'laporan',
            'active' => 'laporan-persediaan',
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

    public function laporanPermintaan()
    {
        $data = [
            'title' => 'Laporan Permintaan',
            'dropdown' => 'laporan',
            'active' => 'laporan-permintaan',
            'hasDatatable' => '0'
        ];

        return view('admin.laporan.permintaan', $data);
    }

    public function cetakLaporanPermintaan(Request $request)
    {
        // Logika untuk mencetak laporan permintaan
        // Misalnya, mengambil data dari database berdasarkan filter yang diberikan

        $format = $request->input('format_laporan');
        $periodeTahun = $request->input('periode_tahun');
        $periodeBulan = $request->input('periode_bulan');
        // Validasi input
        if (!$format || !$periodeTahun || !$periodeBulan) {
            return redirect()->back()->with('error', 'Format laporan, tahun, dan bulan harus dipilih.');
        }
        // Ambil data permintaan berdasarkan tahun dan bulan yang dipilih
        // Misalnya, menggunakan model Permintaan untuk mengambil data
        if ($periodeBulan == 'all') {
            $dataPermintaan = Permintaan::whereYear('tanggal_permintaan', $periodeTahun)
                ->with(['barang']) // Asumsi ada relasi issuedBy untuk mengambil nama yang mengeluarkan permintaan
                ->get();
        } else {
            $dataPermintaan = Permintaan::whereYear('tanggal_permintaan', $periodeTahun)
                ->whereMonth('tanggal_permintaan', $periodeBulan)
                ->with(['barang']) // Asumsi ada relasi issuedBy untuk mengambil nama yang mengeluarkan permintaan
                ->get();
        }


        // Ambil data permintaan sesuai dengan format yang dipilih
        // Proses data dan cetak laporan sesuai format yang dipilih (PDF/Excel)
        $pdf = Pdf::loadView('admin.laporan.export.permintaan-pdf', [
            'dataPermintaan' => $dataPermintaan,
        ]);

        return $pdf->download('laporan_permintaan.pdf');
    }

    public function laporanPenerimaan()
    {
        $data = [
            'title' => 'Laporan Penerimaan',
            'dropdown' => 'laporan',
            'active' => 'laporan-penerimaan',
            'hasDatatable' => '0'
        ];

        return view('admin.laporan.penerimaan', $data);
    }

    public function cetakLaporanPenerimaan(Request $request)
    {
        // Logika untuk mencetak laporan penerimaan
        // Misalnya, mengambil data dari database berdasarkan filter yang diberikan

        $format = $request->input('format_laporan');
        $periodeTahun = $request->input('periode_tahun');
        $periodeBulan = $request->input('periode_bulan');
        // Validasi input
        if (!$format || !$periodeTahun || !$periodeBulan) {
            return redirect()->back()->with('error', 'Format laporan, tahun, dan bulan harus dipilih.');
        }
        // Ambil data penerimaan berdasarkan tahun dan bulan yang dipilih
        // Misalnya, menggunakan model penerimaan untuk mengambil data
        if ($periodeBulan == 'all') {
            $dataPenerimaan = Penerimaan::whereYear('tanggal_penerimaan', $periodeTahun)
                ->with(['barang']) // Asumsi ada relasi issuedBy untuk mengambil nama yang mengeluarkan penerimaan
                ->get();
        } else {
            $dataPenerimaan = Penerimaan::whereYear('tanggal_penerimaan', $periodeTahun)
                ->whereMonth('tanggal_penerimaan', $periodeBulan)
                ->with(['barang']) // Asumsi ada relasi issuedBy untuk mengambil nama yang mengeluarkan penerimaan
                ->get();
        }


        // Ambil data penerimaan sesuai dengan format yang dipilih
        // Proses data dan cetak laporan sesuai format yang dipilih (PDF/Excel)
        $pdf = Pdf::loadView('admin.laporan.export.penerimaan-pdf', [
            'dataPenerimaan' => $dataPenerimaan,
        ]);

        return $pdf->download('laporan_penerimaan.pdf');
    }
}
