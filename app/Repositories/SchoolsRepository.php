<?php
    
    
    namespace App\Repositories;
    
    
    use App\School;

    class SchoolsRepository
        extends Repository
    {
        
        protected $user_rep;
        protected $role_rep;
        
        public function __construct(School $school, UsersRepository $user_rep, RolesRepository $role_rep)
        {
            $this->model = $school;
            $this->user_rep = $user_rep;
            $this->role_rep = $role_rep;
        }
    
        public function saveAdmin($request)
        {
            $data = $request->except('_token');
            $school = $this->getWhere($data['id']);
            $school->name = $data['name'];
            $school->admin_id = $data['admin_id'];
            $school->save();
            if ($data['admin_id']) {
                $user = $this->user_rep->getWhere($data['admin_id']);
                $user->saveRoles($this->role_rep->getWhere('SchoolAdmin', 'name'));
            }
            return ['status' => 'Інформацію про школу оновлено'];
        }
        
    }
