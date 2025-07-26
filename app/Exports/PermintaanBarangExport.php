<?php

namespace App\Exports;

use App\Models\Permintaan;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PermintaanBarangExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $periodeTahun;
    protected $periodeBulan;

    public function __construct($periodeTahun = null, $periodeBulan = null)
    {
        $this->periodeTahun = $periodeTahun;
        $this->periodeBulan = $periodeBulan;
    }

    public function collection()
    {
        // Ambil data permintaan
        $query = Permintaan::with('barang');

        // Filter data berdasarkan periode tahun dan bulan
        if ($this->periodeTahun) {
            $query->whereYear('tanggal_permintaan', $this->periodeTahun);
        }

        if ($this->periodeBulan && $this->periodeBulan !== 'all') {
            $query->whereMonth('tanggal_permintaan', $this->periodeBulan);
        }

        $dataPermintaan = $query->get();

        // Map data untuk disesuaikan dengan kolom yang Anda inginkan
        return $dataPermintaan->map(function ($permintaan) {
            // Format tanggal menggunakan Carbon
            $tanggalFormatted = Carbon::parse($permintaan->tanggal_permintaan)->locale('id')->isoFormat('D MMMM YYYY');
            return [
                'ID Permintaan' => $permintaan->id_permintaan,
                'Issued by' => $permintaan->issued_by,
                'Nama Barang' => optional($permintaan->barang)->nama_barang, // Menggunakan optional() untuk menghindari error jika relasi 'barang' null
                'Jumlah Permintaan' => $permintaan->jumlah_permintaan,
                'Satuan' => optional($permintaan->barang)->satuan_barang, // Menggunakan optional() untuk menghindari error jika relasi 'barang' null
                'Tanggal Permintaan' => $tanggalFormatted,
                'Status Permintaan' => $permintaan->status_permintaan,
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID Permintaan',
            'Issued by',
            'Nama Barang',
            'Jumlah Permintaan',
            'Satuan',
            'Tanggal Permintaan',
            'Status Permintaan'
        ];
    }
}
