<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    use HasFactory;

    protected $table = 'temu_dokter';
    protected $primaryKey = 'idreservasi_dokter';

    public $timestamps = false;

    public $incrementing = true; 
    protected $keyType = 'int';

    protected $fillable = [
        'idpet',
        'iddokter',
        'no_urut',
        'waktu_daftar',
        'status',
    ];

    protected $casts = [
        
        'waktu_daftar' => 'datetime',
    ];
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'iddokter', 'iddokter');
    }
}