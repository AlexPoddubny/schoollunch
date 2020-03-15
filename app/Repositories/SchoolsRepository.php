<?php
    
    
    namespace App\Repositories;
    
    
    use App\School;
    use App\User;

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
    
        public function saveSchool($request)
        {
            $data = $request->except('_token');
            $school = $this->getWhere($data['id']);
            $school->name = $data['name'];
            $type = false;
            if (isset($data['admin_id'])){
                $type = 'admin_id';
                $role_name = 'SchoolAdmin';
            }
            if (isset($data['cook_id'])){
                $type = 'cook_id';
                $role_name = 'Cook';
            }
            if ($type && isset($data[$type])){
                $school->$type = $data[$type];
                User::addRole($data[$type], $role_name);
            }
            $school->save();
            return ['status' => 'Інформацію про школу оновлено'];
        }
        
    }
