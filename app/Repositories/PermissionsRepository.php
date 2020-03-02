<?php
    
    
    namespace App\Repositories;
    
    
    use App\Permission;
    use Gate;

    class PermissionsRepository
        extends Repository
    {
        
        protected $role_rep;
        
        public function __construct(Permission $permission, RolesRepository $role_rep)
        {
            $this->model = $permission;
            $this->role_rep = $role_rep;
        }
    
        public function changePermissions ($request) {
        
            if(Gate::denies('change', $this->model)) {
//                abort(403);
            }
            $data = $request->except('_token');
            $role = $this->role_rep->getWhere(array_key_first($data));
            $role->savePermissions($data[$role->id]);
            return ['status' => 'Права оновлено'];
        }
    
    }
