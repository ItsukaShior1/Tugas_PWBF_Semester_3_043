<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailRekamMedis extends Model
{
    use HasFactory;

    /**
     * 
     * @var string
     */
    protected $table = 'detail_rekam_medis';
    
    /**
     * 
     * @var string
     */
    protected $primaryKey = 'iddetail_rekam_medis';

    /**
     *
     * @var string
     */

    
    /**
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'idrekam_medis',
        'idkode_tindakan_terapi', 
        'detail',
    ];

    public $timestamps = false; 


    public function rekamMedis(): BelongsTo
    {
        return $this->belongsTo(RekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }

    public function kodeTindakanTerapi(): BelongsTo
    {
        return $this->belongsTo(KodeTindakan::class, 'idkode_tindakan_terapi', 'idkode_tindakan_terapi');
    }
}