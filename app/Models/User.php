<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    // ✅ Sesuaikan nama tabel
    protected $table = 'users';
    protected $primaryKey = 'iduser';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    // ✅ Agar Breeze tahu pakai iduser
    public function getAuthIdentifierName()
    {
        return $this->primaryKey;
    }

    protected $fillable = ['nama', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    // 🔐 Auto-hash password
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = Hash::needsRehash($value)
                ? Hash::make($value)
                : $value;
        }
    }

    // 🔗 Relasi ke role_user (One to Many)
    public function roleUsers()
    {
        return $this->hasMany(RoleUser::class, 'iduser', 'iduser');
    }

    // 🔗 Relasi ke role (Many to Many)
    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'role_user',
            'iduser',
            'idrole'
        )->withPivot('status');
    }

    // 🔗 Relasi ke pemilik
    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }

    // 🟢 Ambil role aktif
    public function activeRole()
    {
        return $this->roles()->wherePivot('status', 1)->first();
    }
}
