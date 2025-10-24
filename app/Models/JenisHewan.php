<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisHewan extends Model
{
    protected $table = 'jenis_hewan'; // ✅ nama tabel yang benar
    protected $primaryKey = 'idjenis_hewan';
    public $timestamps = false;

    protected $fillable = ['nama_jenis_hewan'];

    public function ras()
    {
        return $this->hasMany(RasHewan::class, 'idjenis_hewan');
    }
}
