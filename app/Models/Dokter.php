<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    // Nama tabel di database
    protected $table = 'dokter'; 
    // Primary Key tabel
    protected $primaryKey = 'iddokter'; 
    public $timestamps = false;

    // Kolom-kolom yang dapat diisi
    protected $fillable = [
        'alamat',
        'no_hp',
        'bidang_dokter', // Kolom baru dari skema PDF
        'jenis_kelamin',
        'iduser' // Foreign key ke tabel users
    ];

    /**
     * Relasi ke User (One to One)
     * Dokter dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}