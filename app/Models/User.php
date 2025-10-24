<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'iduser';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nama', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    // Mutator: otomatis hash password saat diset
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
        }
    }

    // Relasi ke role_user
    public function roleUsers()
    {
        return $this->hasMany(RoleUser::class, 'iduser', 'iduser');
    }

    // Relasi ke roles melalui role_user
    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'role_user',
            'iduser',
            'idrole'
        )->withPivot('status');
    }

    // Ambil role aktif
    public function activeRole()
    {
        return $this->roles()->wherePivot('status', 1)->first();
    }
}
