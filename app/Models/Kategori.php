<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'idkategori';
    public $timestamps = false;

    protected $fillable = [
        'nama_kategori',
        'keterangan'
    ];

    // Relasi ke Kode Tindakan (One to Many)
    public function kodeTindakan()
    {
        return $this->hasMany(KodeTindakan::class, 'idkategori', 'idkategori');
    }
}
