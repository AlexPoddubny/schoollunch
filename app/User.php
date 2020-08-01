<?php
    
    namespace App;
    
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Support\Str;
    
    
    class User extends Authenticatable implements MustVerifyEmail
    {
        use Notifiable;
        
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'phone', 'email', 'firstname', 'middlename', 'lastname', 'sex', 'password',
        ];
        
        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password', 'remember_token',
        ];
        
        /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];
        
        /* Relations */
        
        public function roles()
        {
            return $this->belongsToMany(Role::class, 'users_roles');
        }
        
        public function school()
        {
            return $this->hasOne(School::class, 'admin_id');
        }
        
        public function cook()
        {
            return $this->hasOne(School::class, 'cook_id');
        }
    
        public function schoolClass()
        {
            return $this->hasOne(SchoolClass::class, 'teacher_id');
        }
    
        public function child()
        {
            return $this->belongsToMany(Student::class, 'children_parents', 'parent_id', 'child_id')
                ->withTimestamps()
                ->withPivot('confirmed_at');
        }
        
        /* Permissions */
        
        public function canDo($permission, $require = false)
        {
            if (is_array($permission)) {
                foreach ($permission as $permName) {
                    $perm = $this->canDo($permName);
                    if ($perm && !$require) {
                        return true;
                    } elseif (!$perm && $require) {
                        return false;
                    }
                }
                return $require;
            } else {
                $roles = $this->roles()->with('permissions')->get();
                foreach ($roles as $role) {
                    foreach ($role->permissions as $perm) {
                        if (Str::is($permission, $perm->name)) {
                            return true;
                        }
                    }
                }
            }
            return false;
        }
        
        public function hasRole($name, $require = false)
        {
            if (is_array($name)) {
                foreach ($name as $roleName) {
                    $hasRole = $this->hasRole($roleName);
                    if ($hasRole && !$require) {
                        return true;
                    } elseif (!$hasRole && $require) {
                        return false;
                    }
                }
                return $require;
            } else {
                foreach ($this->roles as $role) {
                    if ($role->name == $name) {
                        return true;
                    }
                }
            }
            return false;
        }
        
        public function saveRoles($inputRoles)
        {
            if (!empty($inputRoles)) {
                $this->roles()->sync($inputRoles);
            } else {
                $this->roles()->detach();
            }
        }
    
        public function saveChild($student)
        {
            if (!empty($student)) {
                $this->child()->attach($student);
            }
        }
    
        public function removeChild($child)
        {
            if (!empty($child)){
                $this->child()->detach($child);
            }
        }
    
        public function addRole($role_name)
        {
            if(!empty($role_name) && !$this->hasRole($role_name)){
                $role = Role::where('name', $role_name)->get()->first();
                $this->roles()->attach($role->id);
            }
        }
    
        public function removeRole($role_name)
        {
            if(!empty($role_name) && $this->hasRole($role_name)){
                $role = Role::where('name', $role_name)->get()->first();
                $this->roles()->detach($role->id);
            }
        }
    
        public function getFullNameAttribute()
        {
            return implode(' ', [$this->lastname, $this->firstname, $this->middlename]);
        }
    
        public function isAdmin()
        {
            return $this->hasRole('Admin');
        }
        
    }
