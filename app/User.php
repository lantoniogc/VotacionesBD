<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cedula', 'nombres', 'apellidos', 'sexo', 'tipo', 'email', 'email_alternativo', 'direccion', 'password',
        'telefono_principal','telefono_alternativo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function hasAccess(array $permissions)
    {
       foreach($this->roles as $role){
            if($role->hasAccess($permissions)){
                return true;
            }
       }
       return false;
    }    
}
