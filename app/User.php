<?php
    
    namespace App;
    
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Support\Str;
    
    
    class User extends Authenticatable
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
        
        public function roles()
        {
            return $this->belongsToMany('App\Role', 'users_roles');
        }
        
        public function school()
        {
            return $this->hasMany('App\School', 'admin_id');
        }
        
        public function cook()
        {
            return $this->hasMany('App\School', 'cook_id');
        }
    
        public function schoolClass()
        {
            return $this->hasOne('App\SchoolClass', 'teacher_id');
        }
        
        public function can($permission, $require = false)
        {
            if (is_array($permission)) {
                foreach ($permission as $permName) {
                    $perm = $this->can($permName);
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
    
        public static function addRole($id, $role_name)
        {
            $user = static::with('roles')->where('id', $id)->first();
            $role = Role::where('name', $role_name)->get()->first();
            $roles = $user->roles->pluck('id')->toArray();
            if (!in_array($role->id, $roles)){
                $roles[] = $role->id;
                $user->saveRoles($roles);
            }
        }
        
    }
