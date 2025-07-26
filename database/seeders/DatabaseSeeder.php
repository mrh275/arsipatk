<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('admin123'), // Password yang sudah di-hash
            'role' => 'admin', // Menambahkan role admin
        ]);
        User::create([
            'name' => 'Staf TU',
            'username' => 'staf_tu',
            'password' => Hash::make('staf123'), // Password yang sudah di-hash
            'role' => 'user', // Menambahkan role user
        ]);

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
        // Hapus data lama jika ada, untuk menghindari duplikasi saat seeding berulang
        Barang::truncate();

        $barangData = [
            // K001: Alat Tulis
            [
                'id_kategori' => 'K001',
                'nama_barang' => 'Pulpen',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K001',
                'nama_barang' => 'Pensil',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K001',
                'nama_barang' => 'Spidol',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K001',
                'nama_barang' => 'Penghapus',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K001',
                'nama_barang' => 'Koreksi (tip-ex)',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],

            // K002: Kertas dan Cetakan
            [
                'id_kategori' => 'K002',
                'nama_barang' => 'Kertas HVS A4', // Dipecah agar lebih spesifik
                'satuan_barang' => 'rim', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K002',
                'nama_barang' => 'Kertas HVS F4', // Dipecah agar lebih spesifik
                'satuan_barang' => 'rim', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K002',
                'nama_barang' => 'Kertas warna',
                'satuan_barang' => 'lembar', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K002',
                'nama_barang' => 'Kertas karton',
                'satuan_barang' => 'lembar', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K002',
                'nama_barang' => 'Amplop',
                'satuan_barang' => 'pak', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K002',
                'nama_barang' => 'Label',
                'satuan_barang' => 'rol', // Menambahkan satuan_barang
            ],

            // K003: Peralatan Meja Kerja
            [
                'id_kategori' => 'K003',
                'nama_barang' => 'Penggaris',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K003',
                'nama_barang' => 'Cutter',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K003',
                'nama_barang' => 'Gunting',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K003',
                'nama_barang' => 'Lem kertas',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K003',
                'nama_barang' => 'Perekat / Solatip',
                'satuan_barang' => 'rol', // Menambahkan satuan_barang
            ],

            // K004: Perlengkapan Penyimpanan
            [
                'id_kategori' => 'K004',
                'nama_barang' => 'Map folder',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K004',
                'nama_barang' => 'Stopmap',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K004',
                'nama_barang' => 'Box file',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K004',
                'nama_barang' => 'Rak dokumen',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],

            // K005: Peralatan Penjilidan dan Pengarsipan
            [
                'id_kategori' => 'K005',
                'nama_barang' => 'Staples',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K005',
                'nama_barang' => 'Isi Ulang Staples',
                'satuan_barang' => 'box', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K005',
                'nama_barang' => 'Paper clip',
                'satuan_barang' => 'box', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K005',
                'nama_barang' => 'Lakban',
                'satuan_barang' => 'rol', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K005',
                'nama_barang' => 'Binder',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K005',
                'nama_barang' => 'Punch hole (pelubang kertas)',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],

            // K006: Peralatan Cetak dan Komputer
            [
                'id_kategori' => 'K006',
                'nama_barang' => 'Tinta printer',
                'satuan_barang' => 'botol', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K006',
                'nama_barang' => 'Toner Printer', // Dipisahkan dari tinta jika maksudnya berbeda
                'satuan_barang' => 'unit', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K006',
                'nama_barang' => 'Flashdisk',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K006',
                'nama_barang' => 'Kabel printer',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],

            // K007: Perlengkapan Meja dan Administrasi
            [
                'id_kategori' => 'K007',
                'nama_barang' => 'Buku agenda',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K007',
                'nama_barang' => 'Buku kwitansi',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K007',
                'nama_barang' => 'Notes/tempel (post-it)',
                'satuan_barang' => 'pak', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K007',
                'nama_barang' => 'Kalender meja',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
            ],
            [
                'id_kategori' => 'K007',
                'nama_barang' => 'Jam meja',
                'satuan_barang' => 'pcs', // Menambahkan satuan_barang
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
                'satuan_barang' => $data['satuan_barang'], // Menambahkan satuan barang dari data
            ]);
            $barangCounter++;
        }
    }
}
