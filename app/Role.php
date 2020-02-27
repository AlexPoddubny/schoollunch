<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = FALSE;
    
    public function users()
    {
        return $this->belongsToMany('App\User', 'users_roles');
    }
    
    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'roles_permissions');
    }
    
}
