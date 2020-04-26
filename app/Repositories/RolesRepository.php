<?php
    
    
    namespace App\Repositories;
    
    
    use App\Role;
    use App\User;
    use Gate;

    class RolesRepository
        extends Repository
    {
    
        protected $user_rep;
        
        public function __construct(Role $role, UsersRepository $user_rep)
        {
            $this->model = $role;
            $this->user_rep = $user_rep;
        }
    
        public function changeRoles($request)
        {
            /*
            if(Gate::denies('change', $this->model)) {
                abort(403);
            }*/
            $data = $request->except('_token');
            $user = $this->user_rep->getWhere($request->input('id'))->first();
            $user->saveRoles($data['roles'] ?? []);
            return ['status' => 'Ролі оновлено'];
        }
        
    }
