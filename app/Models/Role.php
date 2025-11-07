<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'idrole';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nama_role'];

    // Relasi ke users via role_user
    public function users()
    {
        return $this->belongsToMany(
            \App\Models\User::class, 
            'role_user',             
            'idrole',                
            'iduser'                 
        )->withPivot('status');
    }
}
