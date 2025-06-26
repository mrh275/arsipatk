<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function barang()
    {
        // Argumen pertama: Model target relasi (Barang::class)
        // Argumen kedua: Foreign key di model Permintaan ('id_barang')
        // Argumen ketiga (opsional): Local key di model Barang (default: primary key model target)
        // Jika primary key Barang juga 'id_barang', maka argumen ketiga bisa dihilangkan.
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
}
