<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
    // Nama tabel di database
    protected $table = 'perawat'; 
    // Primary Key tabel
    protected $primaryKey = 'idperawat'; 
    public $timestamps = false;

    // Kolom-kolom yang dapat diisi
    protected $fillable = [
        'alamat',
        'no_hp',
        'jenis_kelamin',
        'pendidikan', // Kolom baru dari skema PDF
        'iduser' // Foreign key ke tabel users
    ];

    /**
     * Relasi ke User (One to One)
     * Perawat dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}