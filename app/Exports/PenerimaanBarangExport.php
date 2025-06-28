<?php

namespace App\Exports;

use App\Models\Penerimaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class PenerimaanBarangExport implements FromCollection, WithHeadings, ShouldAutoSize
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
        // Ambil data penerimaan
        $query = Penerimaan::with('barang');

        // Filter data berdasarkan periode tahun dan bulan
        if ($this->periodeTahun) {
            $query->whereYear('tanggal_penerimaan', $this->periodeTahun);
        }

        if ($this->periodeBulan && $this->periodeBulan !== 'all') {
            $query->whereMonth('tanggal_penerimaan', $this->periodeBulan);
        }

        $dataPenerimaan = $query->get();

        // Map data untuk disesuaikan dengan kolom yang diinginkan
        return $dataPenerimaan->map(function ($penerimaan) {
            // Format tanggal menggunakan Carbon
            $tanggalFormatted = Carbon::parse($penerimaan->tanggal_penerimaan)->locale('id')->isoFormat('D MMMM YYYY');

            return [
                'ID Penerimaan' => $penerimaan->id_penerimaan,
                'Nama Barang' => optional($penerimaan->barang)->nama_barang,
                'Jumlah' => $penerimaan->jumlah,
                'Satuan' => $penerimaan->satuan_barang,
                'Tanggal Penerimaan' => $tanggalFormatted,
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID Penerimaan',
            'Nama Barang',
            'Jumlah',
            'Satuan',
            'Tanggal Penerimaan',
        ];
    }
}
