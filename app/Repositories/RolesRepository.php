<?php
    
    
    namespace App\Repositories;
    
    
    use App\Role;

    class RolesRepository
        extends Repository
    {
        public function __construct(Role $role)
        {
            $this->model = $role;
        }
    
        public function changeRoles($request)
        {
            $roles = $request->only('roles');
            dd($roles);
        }
        
    }
