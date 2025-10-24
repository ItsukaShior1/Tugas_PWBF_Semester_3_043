<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'idrole';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nama_role'];

    // Relasi ke users melalui role_user
    public function users()
    {
        return $this->belongsToMany(
            \App\Models\User::class, // model yang dituju
            'role_user',             // tabel pivot
            'idrole',                // foreign key di pivot untuk model ini (Role)
            'iduser'                 // foreign key di pivot untuk model user
        )->withPivot('status');
    }
}
