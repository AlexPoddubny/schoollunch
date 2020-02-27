<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $timestamps = FALSE;
    
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'roles_permissions');
    }
    
}
