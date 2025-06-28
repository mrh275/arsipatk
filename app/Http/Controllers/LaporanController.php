<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penerimaan;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use App\Exports\BarangExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PenerimaanBarangExport;
use App\Exports\PermintaanBarangExport;

class LaporanController extends Controller
{
    public function laporanPersediaan()
    {
        // Cek apakah pengguna sudah login
        if (!session()->has('username')) {
            return redirect('/')->with('error', 'Anda harus login terlebih dahulu.');
        }


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

        // Proses data dan cetak laporan sesuai format yang dipilih (PDF/Excel)
        if ($format == 'excel') {
            // Jika formatnya Excel, gunakan Maatwebsite Excel
            return Excel::download(new BarangExport, 'laporan-persediaan-barang.xlsx');
        } else {
            $pdf = Pdf::loadView('admin.laporan.export.persediaan-pdf', [
                'dataBarang' => $dataBarang,
                'format' => $format
            ]);

            return $pdf->download('laporan_persediaan-barang.pdf');
        }
    }

    public function laporanPermintaan()
    {
        // Cek apakah pengguna sudah login
        if (!session()->has('username')) {
            return redirect('/')->with('error', 'Anda harus login terlebih dahulu.');
        }

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
        if ($format == 'excel') {
            // Jika formatnya Excel, gunakan Maatwebsite Excel
            return Excel::download(new PermintaanBarangExport($periodeTahun, $periodeBulan), 'laporan-permintaan-barang.xlsx');
        } else {
            $pdf = Pdf::loadView('admin.laporan.export.permintaan-pdf', [
                'dataPermintaan' => $dataPermintaan,
            ]);

            return $pdf->download('laporan_permintaan.pdf');
        }
    }

    public function laporanPenerimaan()
    {
        // Cek apakah pengguna sudah login
        if (!session()->has('username')) {
            return redirect('/')->with('error', 'Anda harus login terlebih dahulu.');
        }

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
        $dataPenerimaan = [];
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
        if ($format == 'excel') {
            // Jika formatnya Excel, gunakan Maatwebsite Excel
            return Excel::download(new PenerimaanBarangExport($periodeTahun, $periodeBulan), 'laporan-penerimaan-barang.xlsx');
        } else {
            $pdf = Pdf::loadView('admin.laporan.export.penerimaan-pdf', [
                'dataPenerimaan' => $dataPenerimaan,
            ]);

            return $pdf->download('laporan_penerimaan.pdf');
        }
    }
}
