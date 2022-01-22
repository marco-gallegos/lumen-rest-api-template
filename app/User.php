<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Lumen\Auth\Authorizable;
use Spatie\Permission\Traits\HasRoles;

class User extends BaseModel implements AuthenticatableContract, JWTSubject, AuthorizableContract
{
    // Eliminación suave y autenticación de usuario
    use SoftDeletes, Authenticatable, Authorizable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    // No exponga las contraseñas al consultar a los usuarios.
    protected $hidden = ['password'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // jwt Metodo a implementar
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // jwt Método a implementar, algunos parámetros personalizados
    public function getJWTCustomClaims()
    {
        return [];
    }
}
