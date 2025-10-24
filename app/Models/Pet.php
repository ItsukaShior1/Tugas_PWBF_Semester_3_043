<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $timestamps = false;

    protected $fillable = [
        'nama_hewan',
        'idjenis_hewan',
        'idras_hewan',
        'idpemilik',
        'tanggal_lahir',
        'jenis_kelamin',
        'berat'
    ];

    // Relasi ke Jenis Hewan
    public function jenis()
    {
        return $this->belongsTo(JenisHewan::class, 'idjenis_hewan', 'idjenis_hewan');
    }

    // Relasi ke Ras Hewan
    public function ras()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }

    // Relasi ke Pemilik
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }
}
