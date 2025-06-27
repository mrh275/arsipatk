<?php

namespace App\Exports;

use App\Models\Penerimaan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PenerimaanBarangExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('admin.laporan.export.penerimaan-excel', [
            'dataPenerimaan' => Penerimaan::with('barang')->get() // Ambil semua data barang dengan relasi kategori
        ]);
    }
}
