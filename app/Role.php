<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = FALSE;
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles');
    }
    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }
    
    public function hasPermission($name, $require = false)
    {
        if (is_array($name)) {
            foreach ($name as $permissionName) {
                $hasPermission = $this->hasPermission($permissionName);
                
                if ($hasPermission && !$require) {
                    return true;
                } elseif (!$hasPermission && $require) {
                    return false;
                }
            }
            return $require;
        } else {
            foreach ($this->permissions as $permission) {
                if ($permission->name == $name) {
                    return true;
                }
            }
        }
        
        return false;
    }
    
    public function savePermissions($inputPermissions)
    {
        if(!empty($inputPermissions)){
            $this->permissions()->sync($inputPermissions);
        } else {
            $this->permissions()->detach();
        }
    }
    
}
