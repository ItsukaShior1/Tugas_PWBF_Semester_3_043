<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RekamMedis extends Model
{
    use HasFactory, SoftDeletes; 

    /**
     *
     * @var string
     */

    
    protected $table = 'rekam_medis';

    /**
     *
     * @var string
     */
    protected $primaryKey = 'idrekam_medis';

    /**
     *
     * @var string
     */
  
    
    /**
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'idreservasi_dokter',
        'dokter_pemeriksa', 
        'anamnesa',
        'temuan_klinis',
        'diagnosa',
    ];

    public $timestamps = false; 
    public function reservasi(): BelongsTo
    {
        return $this->belongsTo(TemuDokter::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }

    public function dokterPemeriksa(): BelongsTo
    {
       
        return $this->belongsTo(Dokter::class, 'dokter_pemeriksa', 'iddokter');
    }

    
    public function details(): HasMany
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }
}