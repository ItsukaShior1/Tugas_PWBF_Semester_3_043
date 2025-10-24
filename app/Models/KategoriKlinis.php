<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriKlinis extends Model
{
    protected $table = 'kategori_klinis';
    protected $primaryKey = 'idkategori_klinis';
    public $timestamps = false;

    protected $fillable = [
        'nama_kategori_klinis',
        'keterangan'
    ];

    // Relasi ke Kode Tindakan (One to Many)
    public function kodeTindakan()
    {
        return $this->hasMany(KodeTindakan::class, 'idkategori_klinis', 'idkategori_klinis');
    }
}
