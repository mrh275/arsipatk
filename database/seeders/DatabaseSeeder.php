<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Kategori::create([
            'id_kategori' => 'K001',
            'nama_kategori' => 'Alat Tulis',
            'slug_kategori' => 'alat-tulis',
        ]);

        Kategori::create([
            'id_kategori' => 'K002',
            'nama_kategori' => 'Kertas dan Cetakan',
            'slug_kategori' => 'kertas-dan-cetakan',
        ]);

        Kategori::create([
            'id_kategori' => 'K003',
            'nama_kategori' => 'Peralatan Meja Kerja',
            'slug_kategori' => 'peralatan-meja-kerja',
        ]);

        Kategori::create([
            'id_kategori' => 'K004',
            'nama_kategori' => 'Peralatan Penyimpanan',
            'slug_kategori' => 'peralatan-penyimpanan',
        ]);

        Kategori::create([
            'id_kategori' => 'K005',
            'nama_kategori' => 'Peralatan Penjilidan dan Pengarsipan',
            'slug_kategori' => 'peralatan-penjilidan-dan-pengarsipan',
        ]);

        Kategori::create([
            'id_kategori' => 'K006',
            'nama_kategori' => 'Peralatan Cetak dan Komputer',
            'slug_kategori' => 'peralatan-cetak-dan-komputer',
        ]);

        Kategori::create([
            'id_kategori' => 'K007',
            'nama_kategori' => 'Perlengkapan Meja dan Administrasi',
            'slug_kategori' => 'perlengkapan-meja-dan-administrasi',
        ]);

        // Hapus data lama jika ada, untuk menghindari duplikasi saat seeding berulang
        Barang::truncate();

        $barangData = [
            // K001: Alat Tulis
            [
                'id_kategori' => 'K001',
                'nama_barang' => 'Pulpen',
            ],
            [
                'id_kategori' => 'K001',
                'nama_barang' => 'Pensil',
            ],
            [
                'id_kategori' => 'K001',
                'nama_barang' => 'Spidol',
            ],
            [
                'id_kategori' => 'K001',
                'nama_barang' => 'Penghapus',
            ],
            [
                'id_kategori' => 'K001',
                'nama_barang' => 'Koreksi (tip-ex)',
            ],

            // K002: Kertas dan Cetakan
            [
                'id_kategori' => 'K002',
                'nama_barang' => 'Kertas HVS A4', // Dipecah agar lebih spesifik
            ],
            [
                'id_kategori' => 'K002',
                'nama_barang' => 'Kertas HVS F4', // Dipecah agar lebih spesifik
            ],
            [
                'id_kategori' => 'K002',
                'nama_barang' => 'Kertas warna',
            ],
            [
                'id_kategori' => 'K002',
                'nama_barang' => 'Kertas karton',
            ],
            [
                'id_kategori' => 'K002',
                'nama_barang' => 'Amplop',
            ],
            [
                'id_kategori' => 'K002',
                'nama_barang' => 'Label',
            ],

            // K003: Peralatan Meja Kerja
            [
                'id_kategori' => 'K003',
                'nama_barang' => 'Penggaris',
            ],
            [
                'id_kategori' => 'K003',
                'nama_barang' => 'Cutter',
            ],
            [
                'id_kategori' => 'K003',
                'nama_barang' => 'Gunting',
            ],
            [
                'id_kategori' => 'K003',
                'nama_barang' => 'Lem kertas',
            ],
            [
                'id_kategori' => 'K003',
                'nama_barang' => 'Perekat / Solatip',
            ],

            // K004: Perlengkapan Penyimpanan
            [
                'id_kategori' => 'K004',
                'nama_barang' => 'Map folder',
            ],
            [
                'id_kategori' => 'K004',
                'nama_barang' => 'Stopmap',
            ],
            [
                'id_kategori' => 'K004',
                'nama_barang' => 'Box file',
            ],
            [
                'id_kategori' => 'K004',
                'nama_barang' => 'Rak dokumen',
            ],

            // K005: Peralatan Penjilidan dan Pengarsipan
            [
                'id_kategori' => 'K005',
                'nama_barang' => 'Staples',
            ],
            [
                'id_kategori' => 'K005',
                'nama_barang' => 'Isi Ulang Staples',
            ],
            [
                'id_kategori' => 'K005',
                'nama_barang' => 'Paper clip',
            ],
            [
                'id_kategori' => 'K005',
                'nama_barang' => 'Lakban',
            ],
            [
                'id_kategori' => 'K005',
                'nama_barang' => 'Binder',
            ],
            [
                'id_kategori' => 'K005',
                'nama_barang' => 'Punch hole (pelubang kertas)',
            ],

            // K006: Peralatan Cetak dan Komputer
            [
                'id_kategori' => 'K006',
                'nama_barang' => 'Tinta printer',
            ],
            [
                'id_kategori' => 'K006',
                'nama_barang' => 'Toner Printer', // Dipisahkan dari tinta jika maksudnya berbeda
            ],
            [
                'id_kategori' => 'K006',
                'nama_barang' => 'Flashdisk',
            ],
            [
                'id_kategori' => 'K006',
                'nama_barang' => 'Kabel printer',
            ],

            // K007: Perlengkapan Meja dan Administrasi
            [
                'id_kategori' => 'K007',
                'nama_barang' => 'Buku agenda',
            ],
            [
                'id_kategori' => 'K007',
                'nama_barang' => 'Buku kwitansi',
            ],
            [
                'id_kategori' => 'K007',
                'nama_barang' => 'Notes/tempel (post-it)',
            ],
            [
                'id_kategori' => 'K007',
                'nama_barang' => 'Kalender meja',
            ],
            [
                'id_kategori' => 'K007',
                'nama_barang' => 'Jam meja',
            ],
        ];

        // Counter untuk id_barang
        $barangCounter = 1;

        foreach ($barangData as $data) {
            Barang::create([
                'id_barang' => 'B' . sprintf('%03d', $barangCounter), // Format B001, B002, dst.
                'id_kategori' => $data['id_kategori'],
                'nama_barang' => $data['nama_barang'],
                'slug_barang' => Str::slug($data['nama_barang']), // Membuat slug otomatis
                'stok_barang' => rand(50, 200), // Stok acak antara 50 dan 200
            ]);
            $barangCounter++;
        }
    }
}
