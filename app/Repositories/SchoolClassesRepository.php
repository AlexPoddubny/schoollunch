<?php
    
    
    namespace App\Repositories;
    
    
    use App\School;
    use App\SchoolClass;
    use App\User;

    class SchoolClassesRepository
        extends Repository
    {
        
        protected $user_rep;
        
        public function __construct(
            SchoolClass $schoolClass,
            UsersRepository $user_rep
        )
        {
            $this->model = $schoolClass;
            $this->user_rep = $user_rep;
        }
    
        public function saveClass($request)
        {
            $data = $request->except('_token');
            $schoolClass = $this->getWhere($data['id'])->first();
            $schoolClass->fill($data);
            if (isset($data['teacher_id'])){
                $user = $this->user_rep->getWhere($data['teacher_id'])->first();
                if ($user && !$user->hasRole('ClassTeacher')){
                    $user->addRole('ClassTeacher');
                }
            }
            $schoolClass->save();
            return ['status' => 'Інформацію про клас оновлено'];
        }
        
    }
