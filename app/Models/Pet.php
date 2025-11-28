<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $timestamps = false; // Nonaktifkan timestamps karena tabel pet tidak memilikinya

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'warna_tanda', // Penting: Ini mengatasi error "Column not found" sebelumnya
        'idjenis_hewan', // Ditambahkan kembali dari model lama
        'idras_hewan',
        'idpemilik',
    ];

    // Relasi ke Pemilik
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    // Relasi ke Ras Hewan
    public function ras()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }
    
    // Relasi ke Jenis Hewan (Ditambahkan kembali dari model lama)
    public function jenis()
    {
        return $this->belongsTo(JenisHewan::class, 'idjenis_hewan', 'idjenis_hewan');
    }
}