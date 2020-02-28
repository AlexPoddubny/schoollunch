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
            $roles = $this->role_rep->get();
            foreach($roles as $value) {
                if(isset($data[$value->id])) {
                    $value->savePermissions($data[$value->id]);
                }
                else {
                    $value->savePermissions([]);
                }
            }
        
            return ['status' => 'Права оновлено'];
        }
    
    }
