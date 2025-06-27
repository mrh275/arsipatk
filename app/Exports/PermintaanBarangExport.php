<?php

namespace App\Exports;

use App\Models\Permintaan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PermintaanBarangExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $dataPermintaan = Permintaan::with(['barang'])->get(); // Ambil semua data permintaan

        return view('admin.laporan.export.permintaan-excel', [
            'dataPermintaan' => $dataPermintaan,
        ]);
    }
}
