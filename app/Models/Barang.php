<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kategori()
    {
        // Argumen pertama: Model target relasi (Kategori::class)
        // Argumen kedua: Foreign key di model Barang ('id_kategori')
        // Argumen ketiga (opsional): Local key di model Kategori (default: primary key model target)
        // Jika primary key Kategori juga 'id_kategori', maka argumen ketiga bisa dihilangkan.
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}
