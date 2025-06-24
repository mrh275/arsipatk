<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kategori;
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
    }
}
