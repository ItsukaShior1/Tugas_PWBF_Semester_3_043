<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RasHewan extends Model
{
    protected $table = 'ras_hewan';
    protected $primaryKey = 'idras_hewan';
    public $timestamps = false;

    protected $fillable = ['idjenis_hewan', 'nama_ras'];

    // Relasi: Ras hewan milik satu jenis hewan
    public function jenis()
    {
        return $this->belongsTo(JenisHewan::class, 'idjenis_hewan', 'idjenis_hewan');
    }
}
