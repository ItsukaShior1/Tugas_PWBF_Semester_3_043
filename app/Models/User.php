<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'iduser';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    public function getAuthIdentifierName()
    {
        return $this->primaryKey;
    }

    protected $fillable = ['nama', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = Hash::needsRehash($value)
                ? Hash::make($value)
                : $value;
        }
    }

    public function roleUsers()
    {
        return $this->hasMany(RoleUser::class, 'iduser', 'iduser');
    }

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'role_user',
            'iduser',
            'idrole'
        )->withPivot('status');
    }

    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }

    public function activeRole()
    {
        return $this->roles()->wherePivot('status', 1)->first();
    }
    public function dokter()
    {
        return $this->hasOne(\App\Models\Dokter::class, 'iduser');
    }
    public function perawat()
    {
        return $this->hasOne(Perawat::class, 'iduser', 'iduser');
    }
}
