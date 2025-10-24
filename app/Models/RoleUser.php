<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $primaryKey = 'idrole_user';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $table = 'role_user';
    protected $fillable = ['iduser', 'idrole', 'status'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'iduser', 'iduser');
    }

    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class, 'idrole', 'idrole');
    }
}
