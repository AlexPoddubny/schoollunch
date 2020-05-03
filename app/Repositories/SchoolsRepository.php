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
            $school = $this->getWhere($data['id'])->first();
            $school->name = $data['name'];
            $type = $data['type'];
            switch ($type){
                case 'admin':
                    $role_name = 'SchoolAdmin';
                    break;
                case 'cook':
                    $role_name = 'Cook';
                    break;
            }
            $type .= '_id';
            $school->$type = $data['user_id'];
            $user = $this->user_rep->getWhere($data['user_id'])->first();
            if ($user && !$user->hasRole($role_name)) {
                $user->addRole($role_name);
            }
            $school->save();
            return ['status' => 'Інформацію про школу оновлено'];
        }
    
        public function getSchoolsWithClasses()
        {
            return $this->model::with('schoolClass.student')->has('schoolClass.student')->get()->keyBy('id')->toArray();
        }
        
    }
