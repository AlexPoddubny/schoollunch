<?php
    
    
    namespace App\Repositories;
    
    
    use App\School;
    use App\SchoolClass;
    use App\User;

    class SchoolClassesRepository
        extends Repository
    {
        
        protected $user_rep;
        protected $role_rep;
        protected $school_rep;
        
        public function __construct(
            SchoolClass $schoolClass,
            UsersRepository $user_rep,
            RolesRepository $role_rep,
            SchoolRepository $school_rep
        )
        {
            $this->model = $schoolClass;
            $this->user_rep = $user_rep;
            $this->role_rep = $role_rep;
            $this->school_rep = $school_rep;
        }
    
        public function saveClass($request)
        {
            $data = $request->except('_token');
            $schoolClass = $this->getWhere($data['id'])->first();
            $schoolClass->name = $data['name'];
            if (isset($data['teacher_id'])){
                $schoolClass->teacher_id = $data['teacher_id'];
                User::addRole($data['teacher_id'], 'ClassTeacher'); //change to attach()
            }
            if (isset($data['break_id'])){
                $schoolClass->break_id = $data['break_id'];
            }
            if (isset($data['category_id'])){
                $schoolClass->category_id = $data['category_id'];
            }
            $schoolClass->save();
            return ['status' => 'Інформацію про школу оновлено'];
        }
        
    }
